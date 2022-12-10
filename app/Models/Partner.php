<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class, 'userID', 'id');
    }

    protected $fillable = [
        'ownerName',
        'restaurantName',
        'restaurantAddress',
        'restaurantContact',
        'restaurantImage',
        'foodType',
    ];

    protected $guarded = [
        'id',
    ];
}
