<?php

namespace App\Models;

use App\Traits\Attributes\ProductDetailAttribute;
use App\Traits\Relationships\ProductDetailRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory,
        ProductDetailRelationship,
        ProductDetailAttribute;

    protected $table  = 'product_details';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
