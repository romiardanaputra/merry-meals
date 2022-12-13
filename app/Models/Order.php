<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function meal(){
        return $this->belongsTo(Meal::class, 'mealID', 'id');
    }

    public function partner(){
        return $this->belongsTo(Partner::class, 'partnerID', 'id');
    }

    public function volunteer(){
        return $this->belongsTo(User::class, 'volunteerID', 'id');
    }
    
    protected $fillable = [
        'userID',
        'partnerID',
        'mealID',
        'volunteerID',
        'mealPackage',
        'range',
        'foodTemperature',
        'status'
    ];

    protected $guarded = [
        'id',
    ];
}
