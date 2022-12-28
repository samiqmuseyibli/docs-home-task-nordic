<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstname",
        "lastname",
        "ssn",
        "phone",
        "email"
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class, 'customerId', 'id');
    }
}
