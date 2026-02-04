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

    public function geolocation()
    {
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

    public function isOpen()
    {
        $now = now();
        $opening = \Carbon\Carbon::createFromFormat('H:i:s', $this->opening_time);
        $closing = \Carbon\Carbon::createFromFormat('H:i:s', $this->closing_time);

        if ($opening->lessThan($closing)) {
            // Standard case: 08:00 to 20:00
            return $now->between($opening, $closing);
        } else {
            // Overnight case: 22:00 to 02:00
            return $now->greaterThanOrEqualTo($opening) || $now->lessThanOrEqualTo($closing);
        }
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
        'opening_time',
        'closing_time',
    ];

    protected $guarded = [
        'id',
    ];
}
