<?php

namespace App\Traits\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ProductDetailAttribute
{
    /**
     * @return Attribute
     */
    protected function productName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->product->name
        );
    }
}
