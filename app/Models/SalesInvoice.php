<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'user_id',
        'sales_invoice_id',
        'product_id',
        'sales_total_amount',
        'sales_invoice_discount',
        'sales_total_discount',
        'sales_amount_collection',
        'sales_amount_due',
        'sales_advance_collection',
        'sales_collection_type',
        'sales_collection_status',
        'date',
        'month',
        'year',
        'sales_invoice_status',
    ];
}
