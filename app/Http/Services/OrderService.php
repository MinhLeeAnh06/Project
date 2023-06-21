<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderService extends BaseService
{
    protected $cartService;
    protected $orderDetailService;
    protected $shoppingSessionService;
    protected $productDetailService;
    protected $productService;
    protected $paymentService;

    public function __construct(
        Order $model,
        CartService $cartService,
        OrderDetailService $orderDetailService,
        ShoppingSessionService $shoppingSessionService,
        ProductDetailService $productDetailService,
        ProductService $productService,
        PaymentService $paymentService
    ) {
        $this->model                  = $model;
        $this->cartService            = $cartService;
        $this->orderDetailService     = $orderDetailService;
        $this->shoppingSessionService = $shoppingSessionService;
        $this->productDetailService   = $productDetailService;
        $this->productService         = $productService;
        $this->paymentService         = $paymentService;
    }

    public function createOrder($request, $orderId = null)
    {
        if ($orderId == null) $orderId = $this->randomOrderId();
        $carts = $this->cartService->showCart($request->user_id);
        $sessionId = $carts->first()->session_id;

        $dataCreate = [
            'order_id'       => $orderId,
            'user_id'        => $request->user_id,
            'amount'         => $carts->count(),
            'total'          => $carts->sum('price') * USD_EXCHANGE_RATE,
            'country'        => $request->country,
            'town_city'      => $request->town_city,
            'status'         => 0,
            'payment_type'   => $request->payment_type,
            'street_address' => $request->street_address
        ];

        DB::beginTransaction();
        try {
            $order = $this->create($dataCreate);

            $cartsArray = $carts->toArray();
            foreach ($cartsArray as $key => $cart) {
                $cartsArray[$key]['order_id'] = $order->order_id;
                $cartsArray[$key]['price'] = $cart['price'] * USD_EXCHANGE_RATE;
                $cartsArray[$key]['created_at'] = now()->toDateTimeString();
                $cartsArray[$key]['updated_at'] = now()->toDateTimeString();
                unset($cartsArray[$key]['id'], $cartsArray[$key]['session_id']);
            }

            $this->orderDetailService->createOrderDetail($cartsArray);
            $this->cartService->deleteCartBySessionId($sessionId);
            $this->shoppingSessionService->deleteShoppingSession($sessionId);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            $status = false;
        }

        return $status;
    }

    public function randomOrderId()
    {
        $nowDate = Carbon::now();
        $str = str_replace('-', '', $nowDate->toDateTimeString());
        $str = str_replace(':', '', $str);
        $str = str_replace(' ', '', $str);
        $order_id = Str::random(6) . '_' . $str;

        return $order_id;
	}

    public function getOrderByUserId($userId)
    {
        return $this->where('user_id', $userId)->get();
    }

    public function showOrderById($orderId)
    {
       return $this->orderDetailService->getOrderDetailByOrderId($orderId);
    }

    public function updateStatus($request)
    {
        $orderId = $request['orderId'];
        $status = $request['status'];

        DB::beginTransaction();
        try {
            $order = $this->where('order_id', $orderId)->first();
            if ($status == $this->model::STATUS_ORDER_CANCEL) {
                if ($order->status != $this->model::STATUS_DELIVERING && $order->status != $this->model::STATUS_DELIVERY_SUCCESSFUL) {
                    $order->update(['status' => $status, 'calculator' => 0]);
                }
            } else {
                $order->update(['status' => $status, 'calculator' => 0]);
                $order = $this->showOrderById($orderId);
                $orderDetail = $order->pluck('quantity', 'product_detail_id')->toArray();
                $product = $order->pluck('quantity', 'product_id')->toArray();

                if ($status == 1 || $status == 0) {
                    foreach ($orderDetail as $productDetailId => $quantity)
                    {
                        $this->productDetailService->deleteQuantityById($productDetailId, $quantity, $status);
                    }

                    foreach ($product as $producId => $quantity)
                    {
                        $this->productService->deleteQuantityById($producId, $quantity, $status);
                    }
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            return false;
        }
    }



    public function getCountOrderByStatusTimeMonth($status, $arrTime)
    {
        $results = $this->model->where('status', $status)
            ->select(DB::raw('MONTH(updated_at) as time'), DB::raw('COUNT(*) AS count'))
            ->whereBetween('updated_at', $arrTime)
            ->groupBy('time')
            ->orderBy('time', 'ASC')
            ->get();

        return $results;
    }
}
