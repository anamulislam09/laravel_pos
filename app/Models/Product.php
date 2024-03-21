<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'auth_id',
        'category_id',
        'product_name',
        'quantity_status',
        'month',
        'year',
        'date',
    ];
}
