<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('partnerID')->constrained('partners', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('mealID')->constrained('meals', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('mealPackage')->default('on going');
            $table->string('status')->default('on going');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
