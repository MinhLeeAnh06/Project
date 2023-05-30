<?php

namespace App\Traits\Relationships;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait OrderDetailRelationship
{
    /**
     * @return BelongsTo
     */
    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function productDetail(): BelongsTo
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'id');
    }
}
