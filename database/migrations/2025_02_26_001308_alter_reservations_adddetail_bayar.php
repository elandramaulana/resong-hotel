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
            $table->double('room_payment')->after('reservation_payment_method');
            $table->double('tax_payment')->after('room_payment');
            $table->double('extrabed_payment')->after('room_payment');
            $table->double('total_payment')->after('extrabed_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('room_payment');
            $table->dropColumn('tax_payment');
            $table->dropColumn('extrabed_payment');
            $table->dropColumn('total_payment');
        });
    }
};
