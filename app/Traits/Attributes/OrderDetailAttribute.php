<?php

namespace App\Traits\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait OrderDetailAttribute
{
    /**
     * @return Attribute
     */
    protected function productImage(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->product->productImages->first()->path
        );
    }

    /**
     * @return Attribute
     */
    protected function productName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->product->name
        );
    }

    /**
     * @return Attribute
     */
    protected function productColor(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->productDetail->color
        );
    }

    /**
     * @return Attribute
     */
    protected function productSize(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->productDetail->size
        );
    }

    /**
     * @return Attribute
     */
    protected function productBasePrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->product->price
        );
    }
}
