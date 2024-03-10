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
        'amount',
        'collect',
        'due',
        'date',
        'month',
        'year',
    ];
}
