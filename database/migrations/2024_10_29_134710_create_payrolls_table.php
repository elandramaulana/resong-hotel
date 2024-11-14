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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->string('periode_payroll');
            $table->integer('hari_kerja')->nullable();
            $table->double('total_penggajian')->nullable();
            $table->integer('jumlah_karyawan')->nullable();
            $table->string('payroll_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_payrolls'); 
        Schema::dropIfExists('payrolls');
    }
};
