<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Models\Product;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckOutController extends Controller
{
//    private $orderService;
//    private $orderDetailService;
    protected $cartService;
    public function __construct(
//        OrderServiceInterface $orderService ,
//        OrderDetailServiceInterface $orderDetailService
        CartService $cartService
    ){
//        $this->orderDetailService = $orderDetailService;
//        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }

    public function index(){

    }
//    public function addOrder(Request $request)
//    {
//        $data = $request->all();
//        $data['status'] = Constant::order_status_ReceiveOrders;
//        $order = $this->orderService->create($data);
//        $carts = Cart::content();
//        foreach ($carts as $cart){
//            $data = [
//                'order_id'=>$order->id ,
//                'product_id'=>$cart->id ,
//                'qty'=>$cart->qty ,
//                'amount'=>$cart->price ,
//                'total'=>$cart->qty * $cart->price ,
//            ];
//            $this->orderDetailService->create($data);
//            //Lay so luong san phan theo id tren db
//            $product = Product::find($cart->id);
//            $productQuantityDB = $product->qty;
//            //tinh so san pham con laij
//            $updateProductQuantity = $productQuantityDB - $cart->qty;
//            //update so luong len db
//            Product::where('id', $cart->id)->update([
//               'qty' => $updateProductQuantity,
//            ]);
////            dd($updateProductQuantity);
//        }
//        if($request->payment_type == 'pay_later'){
//            $total = Cart::total();
//            $subtotal = Cart::subtotal();
//            Cart::destroy();
//            return redirect('checkout/result')->with('notification',
//                'Success! you will pay on Deliver . Pleas check your Email');
//        }
//    }
//
//    public function result()
//    {
//        $notification = session('notification');
//
//        return view('front.checkout.result',compact('notification'));
//    }

}
