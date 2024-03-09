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
        'amount',
        'paid',
        'due',
        'date',
        'month',
        'year',
    ];
}
