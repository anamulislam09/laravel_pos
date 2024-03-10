<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'user_id',
        'category_id',
        'product_name',
        'product_code',
        'product_unit',
        'product_unit_per_rate',
        'total_price_without_discount',
        'total_price_after_discount',
        'collect',
        'due',
        'date',
        'month',
        'year',
    ];
}
