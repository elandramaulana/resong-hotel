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
        Schema::table('late_point_settings', function (Blueprint $table) {
            $table->double('extrabed_price', 10, 2)->nullable()->after('id');
            $table->double('pajak_checkin', 10, 2)->nullable()->after('extrabed_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('late_point_settings', function (Blueprint $table) {
            $table->dropColumn('extrabed_price');
            $table->dropColumn('pajak_checkin');
        });
    }
};
