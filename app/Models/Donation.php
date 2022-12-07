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
        // 'address',
        'donatorPhone',
        'description'
    ];
    protected $guarded = ['donationID'];
}
