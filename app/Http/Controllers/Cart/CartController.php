<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $dataRequest = $this->fakeData(1);
        $this->cartService->addCart($dataRequest);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $carts = $this->cartService->showCart();
        return view('front.shop.cart', compact('carts'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $result = $this->cartService->deleteCart($id);

        return response()->json([
            'status' => $result['status'] ? true : false,
            'view_cart' => $result['view_cart'],
            'view_total' => $result['view_total'],
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionCart(Request $request, $id)
    {
        $result = $this->cartService->actionCart($request, $id);

        return response()->json([
            'status' => $result['status'] ? true : false,
            'view_cart' => $result['view_cart'],
            'view_total' => $result['view_total'],
        ]);
    }

    private function fakeData($index) {
        $data = [
            [
                'productId' => 8,
                'color' => 'red',
                'size' => 'L'
            ],
            [
                'productId' => 15,
                'color' => 'red',
                'size' => 'M'
            ],
        ];

        return $data[$index];
    }
}
