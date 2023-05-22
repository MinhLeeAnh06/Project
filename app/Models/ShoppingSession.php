<?php

namespace App\Models;

use App\Traits\Relationships\ShoppingSessionRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSession extends Model
{
    use HasFactory,
        ShoppingSessionRelationship;

    protected $table = 'shopping_session';

    protected $fillable = [
        'user_id',
        'amount',
    ];

    const TIME_COOKIE_VIEWED_TO_EXIST = 60 * 24 * 60;
}
