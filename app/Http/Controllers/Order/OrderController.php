<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $result = $this->orderService->createOrder($request);

        return $result ? to_route('home') : to_route('order.index');
    }

    public function index()
    {
        $orders = $this->orderService->all();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $orderDetails = $this->orderService->showOrderById($id);
        return view('admin.order.show', compact('orderDetails'));
    }

    public function updateStatus($status, $orderId)
    {
        $result = $this->orderService->updateStatus($status, $orderId);

        return response()->json([
            'status' => $result,
            'update' => $status ? true : false
        ]);
    }

    public function destroy()
    {

    }
}
