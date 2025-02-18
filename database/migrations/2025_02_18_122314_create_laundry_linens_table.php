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
        Schema::create('laundry_linens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item');
            $table->integer('jumlah_satuan');
            $table->date('tgl_keluar')->nullable();
            $table->integer('user_id_keluar')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->integer('user_id_masuk')->nullable();
            $table->double('harga')->nullable();
            $table->string('invoice_laundry')->nullable();
            $table->enum('status', ['keluar', 'proses', 'masuk']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_linens');
    }
};
