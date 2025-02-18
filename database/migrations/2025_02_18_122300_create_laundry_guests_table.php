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
        Schema::create('laundry_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained('rooms');
            $table->string('jenis_laundry');
            $table->text('catatan')->nullable();
            $table->double('harga')->nullable();
            $table->date('tgl_laundry_keluar')->nullable();
            $table->integer('fo_user_id_keluar')->nullable();
            $table->date('tgl_laundry_masuk')->nullable();
            $table->integer('fo_user_id_masuk')->nullable();
            $table->enum('status', ['keluar', 'masuk']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_guests');
    }
};
