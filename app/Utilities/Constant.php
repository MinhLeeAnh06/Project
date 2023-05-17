<?php

namespace App\Utilities;

class Constant
{
    // Order
    const order_status_Unconfirmed = 1;
    const order_status_ReceiveOrders = 2;
    const order_status_Shipping = 3;
    const order_status_Received = 4;
    const order_status_Cancelled = 5;

    public static $order_status = [
        self::order_status_Unconfirmed  =>'Unconfirmed',
        self::order_status_ReceiveOrders=>'Receive Orders',
        self::order_status_Shipping  =>'Shipping',
        self::order_status_Received=>'Received',
        self::order_status_Cancelled  =>'Cancelled ',
    ];
    // User
    const user_level_host = 0;
    const user_level_admin = 1;
    const user_level_client = 2;
    public static $user_level = [
        self::user_level_host=>'host',
        self::user_level_admin=>'admin',
        self::user_level_client=>'client',
    ];
}
