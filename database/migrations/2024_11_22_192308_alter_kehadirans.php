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
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->unsignedBigInteger('shift_id')->after('khd_id');
            $table->string('s_nama')->after('shift_id');
            $table->string('s_clock_in')->after('s_nama');
            $table->string('s_clock_out')->after('s_clock_in');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->dropColumn('shift_id');
            $table->dropColumn('s_nama');
            $table->dropColumn('s_clock_in');
            $table->dropColumn('s_clock_out');
        });
    }
};
