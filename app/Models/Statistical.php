<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;

    protected $table = 'statistical';
    protected $fillable = [
        'day',
        'revenue',
        'best_selling_product',
        'best_selling_color',
        'best_selling_size',
        'delivering_order',
        'success_order',
        'cancel_order',
    ];
}
