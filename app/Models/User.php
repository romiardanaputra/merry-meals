<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory;

  protected $table = 'users';
  protected $primaryKey = 'id';
  protected $guarded = 'id';

  const ROLE_SUPERADMIN = 'superadmin';
  const ROLE_ADMIN = 'admin';
  const ROLE_MEMBER = 'member';
  const ROLE_PARTNER = 'partner';
  const ROLE_DRIVER = 'driver';

  protected $fillable = [
    'name',
    'username',
    'email',
    'phone',
    'password',
    'role',
  ];

  public function isSuperAdmin()
  {
    return $this->role === self::ROLE_SUPERADMIN;
  }

  public function isAdmin()
  {
    return $this->role === self::ROLE_ADMIN;
  }

  public function isMember()
  {
    return $this->role === self::ROLE_MEMBER;
  }

  public function isPartner()
  {
    return $this->role === self::ROLE_PARTNER;
  }

  public function isDriver()
  {
    return $this->role === self::ROLE_DRIVER;
  }


  public function partner()
  {
    return $this->hasOne(Partner::class, 'userID', 'id');
  }

  public function order()
  {
    return $this->hasMany(Order::class, 'userID', 'id');
  }

  public function geolocation()
  {
    return $this->hasOne(Geolocation::class, 'userID', 'id');
  }

  public function survey()
  {
    return $this->hasOne(Survey::class, 'userID', 'id');
  }

}
