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
        Schema::create('transaction_reports', function (Blueprint $table) {
            $table->id();
            $table->string('tabel_referensi');
            $table->integer('id_referensi');
            $table->string('type_transaksi');
            $table->string('jenis_transaksi');
            $table->date('besar_transaksi');
            $table->text('keterangan_transaksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_reports');
    }
};
