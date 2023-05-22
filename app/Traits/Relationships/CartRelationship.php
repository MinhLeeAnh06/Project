<?php

namespace App\Traits\Relationships;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CartRelationship
{
    /**
     * @return BelongsTo
     */
    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
