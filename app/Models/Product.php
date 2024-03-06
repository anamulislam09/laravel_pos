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
        'product_name',
        'product_slug',
        'product_unit',
        'purchase_price',
        'selling_price',
        'descount_price',
        'product_thumbnail',
        'month',
        'year',
        'date',
    ];
}
