<?php

namespace App\Http\Controllers\Payment;

use App\Http\Services\OrderService;
use App\Http\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PaymentController
{
    protected $orderService;
    protected $paymentService;
    public function __construct(
        OrderService $orderService,
        PaymentService $paymentService
    ){
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        Session::put('infoOrder', json_encode($request->all()));
        return view('vnpay.vnpay_pay', ['amount' => $request->total * USD_EXCHANGE_RATE, 'dola' => $request->total]);
    }

    public function vnpayPayment(Request $request)
    {
        $vnp_TxnRef = $this->orderService->randomOrderId(); //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount = $_POST['amount']; // Số tiền thanh toán
        $vnp_Locale = $_POST['language']; //Ngôn ngữ chuyển hướng thanh toán
        $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => env('VNP_TMNCODE'),
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:".$vnp_TxnRef,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => route('payment.vnpay.vnpay_return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASHSECRET')) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, env('VNP_HASHSECRET'));
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();
    }

    public function vnpayReturn(Request $request)
    {

        $inputData = array();
        $returnData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, env('VNP_HASHSECRET'));

        DB::beginTransaction();
        try {
            if ($secureHash == $vnp_SecureHash && $inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                $status = 1; // Trạng thái thanh toán thành công
                $infoOrder = json_decode(Session::get('infoOrder'));
                $this->orderService->createOrder($infoOrder, $inputData['vnp_TxnRef']);
                $inputData['vnp_SecureHash'] = $vnp_SecureHash;
                $inputData['vnp_Amount'] = $inputData['vnp_Amount']/100;
                $this->paymentService->create($inputData);
                Session::forget('infoOrder');
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd(1);
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
    }
}
