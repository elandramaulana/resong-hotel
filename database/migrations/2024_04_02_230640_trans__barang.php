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
        Schema::create('trans_barang', function (Blueprint $table) {
            $table->id();
            $table->string('barang_id');
            $table->integer('trans_jml');
            $table->integer('trans_harga')->nullable();;
            $table->string('trans_suplier')->nullable();
            $table->string('trans_jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_barang');
    }
};
