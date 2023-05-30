<?php

namespace App\Models;

use App\Traits\Attributes\OrderDetailAttribute;
use App\Traits\Relationships\OrderDetailRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory,
        OrderDetailRelationship,
        OrderDetailAttribute;

    protected $table      = 'order_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id',
        'product_id',
        'product_detail_id',
        'quantity'
    ];
}
