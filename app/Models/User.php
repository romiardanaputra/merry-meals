<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public function partner(){
        return $this->hasOne(Partner::class);
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
