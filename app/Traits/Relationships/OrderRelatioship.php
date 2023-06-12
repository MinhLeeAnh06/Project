<?php

namespace App\Traits\Relationships;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait OrderRelatioship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
