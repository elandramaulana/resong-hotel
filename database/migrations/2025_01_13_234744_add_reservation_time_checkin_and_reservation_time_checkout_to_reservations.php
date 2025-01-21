<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->time('reservation_time_checkin')->nullable()->after('reservation_checkin');
            $table->time('reservation_time_checkout')->nullable()->after('reservation_checkout');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('reservation_time_checkin');
            $table->dropColumn('reservation_time_checkout');
        });
    }
};
