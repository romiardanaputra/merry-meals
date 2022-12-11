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
    
    protected $fillable = [
        'userID',
        'partnerID',
        'mealID',
        'mealPackage',
        'radius',
        'foodTemperature',
        'status'
    ];

    protected $guarded = [
        'id',
    ];
}
