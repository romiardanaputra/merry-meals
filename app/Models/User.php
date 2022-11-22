<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullName',
        'username',
        'email',
        'phoneNumber',
        'age',
        'address',
        'password',
        'role'
    ];

    protected $guarded = ['id'];
}
