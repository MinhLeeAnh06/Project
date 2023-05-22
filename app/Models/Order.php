<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table      = 'orders';
    protected $primaryKey = 'order_id';
    protected $keyType    = 'string';
    public $incrementing  = false;

    public $fillable = [
        'user_id',
        'amount',
        'total',
        'payment_type',
        'company_name',
        'country',
        'street_address',
        'postcode_zip',
        'town_city',
        'status',
    ];
}
