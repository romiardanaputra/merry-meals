<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partnerID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('mealName');
            $table->string('mealIngredient');
            $table->string('mealImage');
            $table->string('mealDescription');
            $table->string('mealType');
            $table->string('mealAvailability');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meals');
    }
};
