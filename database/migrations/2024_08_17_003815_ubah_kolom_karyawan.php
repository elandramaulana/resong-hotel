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
        Schema::table('karyawan', function (Blueprint $table) {
            $table->integer('k_pin')->after('k_nik');
            $table->boolean('k_biometric_status')->after('k_pin');
            $table->unsignedBigInteger('k_divisi')->after('k_nik');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan', function (Blueprint $table) {
            $table->integer('k_pin')->after('k_nik');
            $table->boolean('k_biometric_status')->after('k_pin');
            $table->unsignedBigInteger('k_divisi')->after('k_nik');
        });
    }
};
