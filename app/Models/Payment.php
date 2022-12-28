<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'amount',
        'description',
        'ref_id',
        'payment_date'
    ];

    protected $dates = [
        'payment_date',
    ];
}
