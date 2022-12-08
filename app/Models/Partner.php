<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'restaurant_name',
        'restaurant_address',
        'contact',
        'restaurant_image',
        'food_type',
    ];

    protected $guarded = [
        'id',
    ];
}
