<?php

namespace App\Traits\Relationships;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ProductDetailRelationship
{
    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
