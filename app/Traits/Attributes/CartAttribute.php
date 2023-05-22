<?php

namespace App\Traits\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait CartAttribute
{
    /**
     * @return Attribute
     */
    protected function imageProduct(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->product->productImages->first()->path,
        );
    }
}
