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
        'product_unit',
        'product_unit_per_rate',
        'month',
        'year',
        'date',
    ];
}
