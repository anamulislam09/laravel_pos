<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'auth_id',
        'supplier_id',
        'product_id',
        'stock_quantity',
        'stock_unit_price',
        'stock_history_status',
        'date',
        'month',
        'year',
    ];
}
