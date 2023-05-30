<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService) {
        $this->cartService =  $cartService;
    }
    public function showViewCheckout()
    {
        $carts = $this->cartService->showCart();
        return view('front.checkout.index',compact('carts'));
    }
}
