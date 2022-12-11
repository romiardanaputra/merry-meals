<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

    protected $fillable = [
        'userID',
        'ip',
        'countryName',
        'countryCode',
        'regionCode',
        'regionName',
        'cityName',
        'zipCode',
        'latitude',
        'longitude',
    ];

    protected $guarded = [
        'id',
    ];
}
