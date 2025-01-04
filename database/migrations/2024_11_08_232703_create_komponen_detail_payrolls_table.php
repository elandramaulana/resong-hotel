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
        Schema::create('komponen_detail_payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_payroll');
            $table->foreign('id_detail_payroll')->references('id')->on('detail_payrolls')->onDelete('cascade');
            $table->string('nama_komponen_payroll');
            $table->double('besaran_komponen_payroll');
            $table->enum('type_komponen_payroll', ['potongan', 'pendapatan']);
            $table->string('keterangan_komponen_payroll')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komponen_detail_payrolls');
    }
};
