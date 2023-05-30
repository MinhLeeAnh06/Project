<?php

namespace App\Http\Services;

use App\Models\OrderDetail;

class OrderDetailService extends BaseService
{
    public function __construct(OrderDetail $model)
    {
        $this->model = $model;
    }

    public function createOrderDetail($data)
    {
        $this->model->insert($data);
    }

    public function getOrderDetailByOrderId($orderId)
    {
        return $this->where('order_id', $orderId)->get();
    }
}
