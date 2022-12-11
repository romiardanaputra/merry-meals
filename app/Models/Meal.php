<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partnerID', 'id');
    }

    public function order(){
        return $this->hasOne(Order::class, 'mealID', 'id');
    }

    protected $fillable = [
        'partnerID',
        'mealName',
        'mealIngredient',
        'mealImage',
        'mealType',
        'mealAvailability',
        'mealDescription'
    ];

    protected $guarded = [
        'id'
    ];
}
