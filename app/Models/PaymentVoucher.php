<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentVoucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'customer_id',
        'auth_id',
        'supplier_id',
        'amount',
        'paid',
        'due',
        'date',
        'month',
        'year',
    ];
}
