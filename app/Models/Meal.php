<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    public function partner(){
        return $this->belongsTo(Partner::class, 'partnerID', 'id');
    }

    protected $fillable = [
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
