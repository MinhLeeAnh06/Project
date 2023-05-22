<?php

namespace App\Traits\Relationships;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ShoppingSessionRelationship
{
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'session_id', 'id');
    }
}
