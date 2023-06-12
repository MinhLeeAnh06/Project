<?php

namespace App\Traits\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait OrderAttribute
{
    /**
     * @return Attribute
     */
    protected function userName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->user->name,
        );
    }


}
