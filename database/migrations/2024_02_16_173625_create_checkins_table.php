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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id')->nullable()->comment('its can be null because if the channel is walk-in, there is no reservation id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('guest_id');
            $table->string('chanel_checkin');
            $table->date('date_checkin');
            $table->date('date_checkout');
            $table->string('guest_adult')->comment('contains qty guest adult in this room');
            $table->string('guest_kids')->comment('contains qty guest kids in this room');
            $table->boolean('is_extrabed')->default(false);
            $table->string('payment_status')->comment('contains payment status ex : Full, Half, Pending');
            $table->integer('payment');
            $table->string('payment_method')->comment('contains payment method ex : Cash, Credit Cards, Qris, eWallet ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkins');
    }
};
