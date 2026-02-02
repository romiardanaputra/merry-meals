<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    /**
     * Get the user that owns this partner profile
     * Partner.userID -> User.id
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function geolocation(){
        return $this->hasOne(Geolocation::class, 'partnerID', 'id');
    }

    /**
     * Get all orders for this partner
     * Order.partnerID -> Partner.id
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'partnerID', 'id');
    }

    protected $fillable = [
        'userID',
        'ownerName',
        'restaurantName',
        'restaurantAddress',
        'restaurantContact',
        'restaurantImage',
        'foodType',
        'status',
    ];

    protected $guarded = [
        'id',
    ];
}
