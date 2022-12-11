<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ownerName');
            $table->string('restaurantName');
            $table->string('restaurantAddress');
            $table->string('restaurantContact');
            $table->string('restaurantImage');
            $table->string('foodType');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partners');
    }
};
