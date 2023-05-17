<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductComment;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class Statistic extends Controller
{
    private $orderService ;
    private $orderDetailService ;
    public function __construct(OrderServiceInterface $orderService , OrderDetailServiceInterface $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product_count = Product::whereBetween('created_at',[request()->created_at, request()->updated_at])->count() ;
        $order_count = Order::whereBetween('created_at',[request()->created_at, request()->updated_at])->count() ;
        $order_new= Order::whereBetween('created_at',[request()->created_at, request()->updated_at])->count('status',1) ;
        $order_total=  OrderDetail::whereBetween('created_at',[request()->created_at, request()->updated_at])->sum('total');
        $product_comment = ProductComment::whereBetween('created_at',[request()->created_at, request()->updated_at])->count() ;
        $orderDetailService = $this->orderDetailService;
        $orders= Order::whereBetween('created_at',[request()->created_at, request()->updated_at])->get() ;
        return view('admin.statistical.index',compact('product_count','order_count','product_comment','order_new','order_total','orders', 'orderDetailService',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
