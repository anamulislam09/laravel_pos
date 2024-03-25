<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'supplier_id',
        'purchase_voucher_id',
        'category_id',
        'product_id',
        'product_quantity',
        'product_unit_per_rate',
        'total_price_without_discount',
        // 'discount',
        // 'discount_price',
        // 'total_price_after_discount',
        'product_thumbnail',
        'date',
        'month',
        'year',
    ];
}
