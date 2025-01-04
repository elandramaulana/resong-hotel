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
        Schema::table('karyawan_has_divisions', function (Blueprint $table) {
            $table->date('khr_tglOut')->nullable()->change(); // Mengubah kolom menjadi nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan_has_divisions', function (Blueprint $table) {
            $table->date('khr_tglOut')->nullable(false)->change(); // Mengembalikan kolom ke kondisi semula (tidak nullable)
        });
    }
};
