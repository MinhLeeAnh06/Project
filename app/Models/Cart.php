<?php

namespace App\Models;

use App\Traits\Attributes\CartAttribute;
use App\Traits\Relationships\CartRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory,
        CartRelationship,
        CartAttribute;

    protected $table = 'cart_item';

    protected $fillable = [
        'session_id',
        'product_id',
        'product_detail_id',
        'quantity',
        'price'
    ];
}
