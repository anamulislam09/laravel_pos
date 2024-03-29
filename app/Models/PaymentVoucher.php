<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_voucher_id',
        'customer_id',
        'auth_id',
        'supplier_id',
        'amount',
        'paid',
        'due',
        'status',
        'date',
        'month',
        'year',
    ];
}
