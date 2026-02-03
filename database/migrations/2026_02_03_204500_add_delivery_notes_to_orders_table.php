<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add deliveryNotes column to orders table for special delivery instructions
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('deliveryNotes')->nullable()->after('range');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('deliveryNotes');
        });
    }
};
