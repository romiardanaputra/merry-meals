<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    public function user(){
        return $this-> belongsTo(User::class, 'id', 'id');
    }

    protected $fillable = [
        'userID',
        'questionOne',
        'questionTwo',
        'questionThree',
        'questionFour',
        'questionFive',
        'questionSix',
        'questionSeven',
        'questionEight',
        'overall'
    ];

    protected $guarded = ['id'];
}
