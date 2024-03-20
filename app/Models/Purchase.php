<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'supplier_id',
        'category_id',
        'purchase_invoice_id',
        'product_name',
        'product_code',
        'product_unit',
        'product_unit_per_rate',
        'total_price_without_discount',
        'discount',
        'discount_price',
        'total_price_after_discount',
        'paid',
        'due',
        'date',
        'month',
        'year',
    ];
}
