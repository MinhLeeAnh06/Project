<?php

namespace App\Models;

use App\Traits\Attributes\OrderAttribute;
use App\Traits\Relationships\OrderRelatioship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory,
        OrderRelatioship,
        OrderAttribute;

    protected $table      = 'orders';
    protected $primaryKey = 'order_id';
    protected $keyType    = 'string';
    public $incrementing  = false;

    public $fillable = [
        'order_id',
        'user_id',
        'amount',
        'total',
        'payment_type',
        'company_name',
        'country',
        'street_address',
        'postcode_zip',
        'town_city',
        'status'
    ];

    const PAY_AFTER_RECIEVE = "Thanh toán sau khi nhận hàng";
    const ONLINE_PAYMENT = "Thanh toán online";

    const APPROVAL = 1;
    const NO_APPROVAL = 0;
}
