<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public function partner(){
        return $this->hasOne(Partner::class, 'userID', 'id');
    }

    public function order(){
        return $this->hasMany(Order::class, 'userID', 'id');
    }

    public function geolocation(){
        return $this->hasOne(Geolocation::class, 'userID', 'id');
    }

    public function survey(){
        return $this->hasOne(Survey::class, 'userID', 'id');
    }

    protected $fillable = [
        'fullName',
        'username',
        'email',
        'phoneNumber',
        'age',
        'address',
        'password',
        'role',
    ];

    protected $guarded = ['id'];
}
