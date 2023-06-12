<?php
use App\Models\Order;

if (! function_exists('getStatusOrder')) {
    function getStatusOrder($status) {
        switch ($status) {
            case Order::STATUS_WAITING_FOR_APPROVAL:
                $result = "Chờ xét duyệt";
                break;
            case Order::STATUS_APPROVED:
                $result = "Đã xét duyệt";
                break;
            case Order::STATUS_DELIVERING:
                $result = "Đang giao hàng";
                break;
            case Order::STATUS_DELIVERY_SUCCESSFUL:
                $result = "Giao hàng thành công";
                break;
            default:
                $result = "Chờ xét duyệt";
                break;
        }

        return $result;
    }
}
