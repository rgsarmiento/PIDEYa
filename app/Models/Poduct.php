<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'description',
        'company_id',
        'price',
        'price_b',
        'price_c',
        'base_quantity',
        'stocks',
    ];
}
