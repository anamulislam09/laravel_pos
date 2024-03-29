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
        'sales_invoice_id',
        'category_id',
        'product_id',
        'sales_item_quantity',
        'sales_item_rate',
        'sales_item_discount',
        'amount',
        'amount_after_discount',
        'date',
        'month',
        'year',
        'sales_invoice_status',
    ];
}
