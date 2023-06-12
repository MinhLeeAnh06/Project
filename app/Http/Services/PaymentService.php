<?php

namespace App\Http\Services;


use App\Models\Payment;

class PaymentService extends BaseService
{
    public function __construct(Payment $model)
    {
        $this->model = $model;
    }
}
