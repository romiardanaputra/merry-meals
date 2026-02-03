<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add performance indexes to orders table
 * 
 * These indexes optimize the most common query patterns:
 * - Dashboard stats filtering by status
 * - Driver queries filtering by volunteerID + status
 * - Partner queries filtering by partnerID + status
 * - Member order history ordered by created_at
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Index for status filtering (very frequently queried)
            $table->index('status', 'orders_status_index');
            
            // Composite index for driver dashboard queries
            $table->index(['volunteerID', 'status'], 'orders_volunteer_status_index');
            
            // Composite index for partner dashboard queries
            $table->index(['partnerID', 'status'], 'orders_partner_status_index');
            
            // Composite index for member order history
            $table->index(['userID', 'created_at'], 'orders_user_created_index');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_status_index');
            $table->dropIndex('orders_volunteer_status_index');
            $table->dropIndex('orders_partner_status_index');
            $table->dropIndex('orders_user_created_index');
        });
    }
};
