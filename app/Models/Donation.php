<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Donation extends Model
{
    use HasFactory;
    use Billable;
    protected $fillable=[
        'donatorName',
        'donatorEmail',
        'donationAmount',
        'donatorPhone',
        'description'
    ];

    /**
     * Boot the model and register event listeners
     */
    protected static function booted(): void
    {
        static::saved(function () {
            app(\App\Services\DashboardCacheService::class)->clearAdminCache();
        });

        static::deleted(function () {
            app(\App\Services\DashboardCacheService::class)->clearAdminCache();
        });
    }
    protected $guarded = ['donationID'];
}
