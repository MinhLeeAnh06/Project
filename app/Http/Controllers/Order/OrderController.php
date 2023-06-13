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
        $orders = $this->orderService->where('status', 4, '!=')->orderBy('created_at', 'DESC')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id)
    {
        $orderDetails = $this->orderService->showOrderById($id);
        return view('admin.order.show', compact('orderDetails'));
    }

    public function updateStatus(Request $request)
    {
        $result = $this->orderService->updateStatus($request->all());

        return response()->json([
            'result' => $result,
            'status' => $request->status,
            'text' => getStatusOrder($request->status),
        ]);
    }

    public function indexOrderCancel()
    {
        $orders = $this->orderService->where('status', 4)->orderBy('updated_at', 'DESC')->get();
        return view('admin.order.order-cancel', compact('orders'));
    }

    public function destroy()
    {

    }
}
