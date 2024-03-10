<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'category_id',
        'supplier_id',
        'product_code',
        'product_name',
        'product_slug',
        'product_unit',
        'product_unit_per_rate',
        'total_price_without_discount',
        'total_price_after_discount',
        'product_thumbnail',
        'month',
        'year',
        'date',
    ];
}
