<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_name',
        'partner_long',
        'partner_lat',
        'partner_location'
    ];

    protected $guarded = [
        'id',
    ];
}
