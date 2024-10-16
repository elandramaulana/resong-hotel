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
        Schema::create('karyawan_has_divisions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("karyawan_id");
            $table->unsignedBigInteger("divisi_id");
            $table->date('khr_tgljoin');
            $table->string('khr_isActive');
            $table->date('khr_tglOut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_has_divisions');
    }
};
