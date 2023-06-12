<?php

namespace App\Http\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService extends BaseService
{
    protected $productService;
    protected $productDetailService;
    protected $shoppingSessionService;
    public function __construct(
        Cart $model,
        ProductService         $productService,
        ProductDetailService   $productDetailService,
        ShoppingSessionService $shoppingSessionService
    ) {
        $this->model = $model;
        $this->productService         = $productService;
        $this->productDetailService   = $productDetailService;
        $this->shoppingSessionService = $shoppingSessionService;
    }

    /**
     * @param $request
     * @return false|void
     */
    public function addCart($request)
    {
        try {
            $productDetail = $this->validate($request); // $request->all()
            if (Auth::user()) {
                $shoppingSession = $this->shoppingSessionService->checkExistShoppingSession(Auth::user()->id);

                if ($shoppingSession) {
                    $this->updateOrInsertCart($shoppingSession->id, $productDetail->product_id, $productDetail->id);
                } else {
                    $this->insertCart(productId: $productDetail->product_id, productDetailId: $productDetail->id);
                }
            } else {
                if (empty($_COOKIE['session_cart'])) {
                    $this->insertCart(productId: $productDetail->product_id, productDetailId: $productDetail->id);
                } else {
                    $this->updateOrInsertCart(Cookie::get('session_cart'), $productDetail->product_id, $productDetail->id);
                }
            }
        } catch (\Exception $e) {
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");

            return false;
        }
    }

    /**
     * @param $cartItem
     * @param $dataUpdate
     * @return void
     */
    private function updateCart($cartItem, $dataUpdate = null)
    {
        DB::beginTransaction();
        try {
            if (empty($dataUpdate)) $dataUpdate = [
                'quantity' => $cartItem->quantity + 1,
                'price'    => $cartItem->price + $this->productService->getPriceProductByProductId($cartItem->product_id)
            ];

            $this->model->where('id', $cartItem->id)->update($dataUpdate);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
        }
    }

    /**
     * @param $sessionId
     * @param $productId
     * @param $productDetailId
     * @param $quantity
     * @return void
     */
    private function insertCart($sessionId = null, $productId, $productDetailId, $quantity = 1)
    {
        DB::beginTransaction();
        try {
            if (empty($sessionId)) $sessionId = $this->shoppingSessionService->storeShoppingSession(Auth::user()->id ?? 0)->id;
            $data = [
                'session_id' => $sessionId,
                'product_id' => $productId,
                'quantity'   => $quantity,
                'price'      => $this->productService->getPriceProductByProductId($productId) * $quantity,
                'product_detail_id' => $productDetailId
            ];
            $this->create($data);

            $this->shoppingSessionService->updateAmountShoppingSession($sessionId);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
        }
    }

    /**
     * @return void
     */
    public function mergeNewCartInOldCart() {
        $newCartDetail = $this->where('session_id', Cookie::get('session_cart'))->get();

        $shoppingSession = $this->shoppingSessionService->checkExistShoppingSession(Auth::user()->id);
        if (!$shoppingSession) $sessionId = $this->shoppingSessionService->storeShoppingSession(Auth::user()->id)->id;
        $oldCartDetail = $this->where('session_id', $sessionId ?? $shoppingSession->id)->get();

        try {
            foreach ($newCartDetail as $newDataCart) {
                $merge = false;
                foreach ($oldCartDetail as $oldDataCart) {
                    if ($newDataCart->product_id != $oldDataCart->product_id || $newDataCart->product_detail_id != $oldDataCart->product_detail_id) {
                        continue;
                    }

                    $dataUpdate = [
                        'quantity' => $oldDataCart->quantity + $newDataCart->quantity,
                        'price'    => $oldDataCart->price + $newDataCart->price
                    ];
                    $this->updateCart($oldDataCart, $dataUpdate);
                    $merge = true;
                    break;
                }

                if (!$merge) {
                    $this->insertCart(
                        sessionId: $sessionId ?? $shoppingSession->id,
                        productId: $newDataCart->product_id,
                        productDetailId: $newDataCart->product_detail_id,
                        quantity: $newDataCart->quantity
                    );
                }
            }

            $this->deleteCartBySessionId($newCartDetail->first()->session_id);
            $this->shoppingSessionService->deleteShoppingSession($newCartDetail->first()->session_id);

        } catch (\Exception $e) {
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|void
     */
    public function showCart($userId = null)
    {
        try {
            if ($userId ?? Auth::user()) {
                $sessionId = $this->shoppingSessionService->checkExistShoppingSession($userId ?? Auth::user()->id)->id;
            }
            $carts = $this->where('session_id', $sessionId ?? Cookie::get('session_cart'))->get();

            return $carts;
        } catch (\Exception $e) {
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteCart($id)
    {
        $result = [];
        try {
            $cartItem = $this->getById($id);
            $cartItem->delete();
            $this->shoppingSessionService->updateAmountShoppingSession($cartItem->session_id);
            $carts = $this->showCart();
            if (!$carts->count()) {
                $this->shoppingSessionService->deleteShoppingSessionByAmount();
                if (!Auth::user()) Cookie::queue(Cookie::forget('session_cart'));
            }
            $view_cart = view('render.cart.tbl_cart', compact('carts'))->render();
            $view_total = view('render.cart.total_cart', compact('carts'))->render();

            $result['status'] = true;
            $result['view_cart'] = $view_cart;
            $result['view_total'] = $view_total;
        } catch (\Exception $e) {
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            $result['status'] = false;
        }

        return $result;
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function actionCart($request, $id)
    {
        $price = $this->productService->getPriceProductByProductId($request->productId);

        $result = [];
        $dataUpdate = [
            'quantity' => $request->quantity,
            'price' => $request->quantity * $price
        ];

        try {
            $this->model->where('id', $id)->update($dataUpdate);
            $carts = $this->showCart();
            $view_cart = view('render.cart.tbl_cart', compact('carts'))->render();
            $view_total = view('render.cart.total_cart', compact('carts'))->render();

            $result['status'] = true;
            $result['view_cart'] = $view_cart;
            $result['view_total'] = $view_total;
        } catch (\Exception $e) {
            Log::error("Error: {$e->getMessage()} --line: {$e->getLine()}");
            $result['status'] = false;
        }

        return $result;
    }

    /**
     * @param $sessionId
     * @param $productId
     * @param $productDetailId
     * @return null
     */
    private function updateOrInsertCart($sessionId, $productId, $productDetailId)
    {
        $cartItem = $this->checkExistProductInCart($sessionId, $productId, $productDetailId);
        if ($cartItem) return $this->updateCart($cartItem);

        return $this->insertCart(sessionId: $sessionId, productId: $productId, productDetailId: $productDetailId);
    }

    /**
     * @param $sessionId
     * @return void
     */
    public function deleteCartBySessionId($sessionId)
    {
        $this->model->where('session_id', $sessionId)->delete();
    }

    /**
     * @param $sessionId
     * @param $productId
     * @param $productDetailId
     * @return false
     */
    private function checkExistProductInCart($sessionId, $productId, $productDetailId)
    {
        $data = [
            ['session_id', $sessionId],
            ['product_id', $productId],
            ['product_detail_id', $productDetailId]
        ];

        $cartItem = $this->model->where($data)->first();

        return $cartItem ?? false;
    }

    /**
     * @param $dataRequest
     * @return array|false|\Illuminate\Support\Optional|mixed
     */
    private function validate($dataRequest)
    {
        $productDetail = $this->productDetailService->getDataProductDetail($dataRequest);
        if(!$productDetail->qty) {
            return [
                'status' => false,
                'msg'    => 'Vui sản phẩm đã hết hàng vui lòng chọn sản phẩm khác'
            ];
        }

        return $productDetail;
    }
}
