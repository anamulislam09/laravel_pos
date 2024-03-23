<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'auth_id',
        'user_id',
        'sales_collection_id',
        'sales_invoice_id',
        'amount',
        'date',
        'month',
        'year',
        'collection_status',
    ];
}
