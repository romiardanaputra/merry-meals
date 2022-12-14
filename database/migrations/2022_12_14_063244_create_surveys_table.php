<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userID')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('questionOne');
            $table->string('questionTwo');
            $table->string('questionThree');
            $table->string('questionFour');
            $table->string('questionFive');
            $table->string('questionSix');
            $table->string('questionSeven');
            $table->string('questionEight');
            $table->string('overall');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surveys');
    }
};
