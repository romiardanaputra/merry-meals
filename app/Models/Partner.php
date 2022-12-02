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
        'food_type',
        'restaurant_address',
        'restaurant_contact',
        'restaurant_image',
    ];

    protected $guarded = [
        'id',
    ];
}
