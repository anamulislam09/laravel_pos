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
        'due_collection_id',
        'invoice_id',
        'amount',
        'date',
        'month',
        'year',
        'collection_status',
    ];
}
