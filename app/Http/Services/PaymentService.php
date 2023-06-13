<?php

namespace App\Http\Services;


use App\Models\Payment;

class PaymentService extends BaseService
{
    public function __construct(Payment $model)
    {
        $this->model = $model;
    }

    public function getInfoPaymentByTxnRef($vnp_TxnRef) {
        return $this->where('vnp_TxnRef', $vnp_TxnRef)
            ->select('vnp_BankCode', 'vnp_TransactionNo', 'vnp_Amount', 'created_at')
            ->get();
    }
}
