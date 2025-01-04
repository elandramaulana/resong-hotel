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
        Schema::create('history_cleaning_room', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_cleaning');
            $table->time('jam_cleaning');
            $table->string('pic_cleaning');
            $table->string('room_no');
            $table->string('status');
            $table->string('room_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_cleaning_room');
    }
};
