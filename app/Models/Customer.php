<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'identification_number',
        'name',
        'address',
        'phone',
        'municipality_id',
        'email',
        'company_id',
    ];
}
