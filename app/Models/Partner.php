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

    public function geolocation(){
        return $this->hasOne(Geolocation::class, 'partnerID', 'id');
    }

    protected $fillable = [
        'userID',
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
