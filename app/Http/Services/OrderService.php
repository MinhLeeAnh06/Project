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

    public function __construct(
        Order $model,
        CartService $cartService,
        OrderDetailService $orderDetailService,
        ShoppingSessionService $shoppingSessionService,
        ProductDetailService $productDetailService
    ) {
        $this->model                  = $model;
        $this->cartService            = $cartService;
        $this->orderDetailService     = $orderDetailService;
        $this->shoppingSessionService = $shoppingSessionService;
        $this->productDetailService = $productDetailService;
    }

    public function createOrder($request)
    {
        $orderId = $this->randomOrderId();
        $carts = $this->cartService->showCart($request->user_id);
        $sessionId = $carts->first()->session_id;

        $dataCreate = [
            'order_id'       => $orderId,
            'user_id'        => $request->user_id,
            'amount'         => $carts->count(),
            'total'          => $carts->sum('price'),
            'country'        => $request->country,
            'town_city'      => $request->town_city,
            'status'         => $request->payment_type ? 1 : 0,
            'payment_type'   => $request->payment_type,
            'street_address' => $request->street_address
        ];

        DB::beginTransaction();
        try {
            $order = $this->create($dataCreate);

            $cartsArray = $carts->toArray();
            foreach ($cartsArray as $key => $cart) {
                $cartsArray[$key]['order_id'] = $order->order_id;
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

    private function randomOrderId()
    {
        $nowDate = Carbon::now();
        $str = str_replace('-', '', $nowDate->toDateTimeString());
        $str = str_replace(':', '', $str);
        $str = str_replace(' ', '', $str);
        $order_id = Str::random(6) . '_' . $str;

        return $order_id;
	}

    public function showOrderById($orderId)
    {
       return $this->orderDetailService->getOrderDetailByOrderId($orderId);
    }

    public function updateStatus($status, $orderId)
    {
        DB::beginTransaction();
        try {
            $order = $this->where('order_id', $orderId)->first();
            $order->update(['status' => $status ? $this->model::NO_APPROVAL : $this->model::APPROVAL]);

            $orderDetail = $this->showOrderById($orderId)->pluck('quantity', 'product_detail_id')->toArray();

            foreach ($orderDetail as $key => $value)
            {
                $this->productDetailService->deleteQuantityById($key, $value, $status);
            }


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            return false;
        }
    }
}
