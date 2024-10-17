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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reservation_chanel')->comment('contains chanel reservation via Phone, Traveloka, etc');
            $table->unsignedInteger('room_id');
            $table->boolean('is_extrabed')->default(false)->comment('for flaging this reservation need extrabed');
            $table->date('reservation_date')->comment('date reservation received');
            $table->date('reservation_checkin')->comment('date checkin reservation');
            $table->date('reservation_checkout')->comment('date checkout resevation');
            $table->boolean('reschedulable')->default(false)->comment('is this reservation can be reschedule ?x ');
            $table->string('reservation_name')->comment('name of reservation');
            $table->string('reservation_contact')->comment('contact reservation');
            $table->string('reservation_email')->nullable()->comment('email reservation, its nullable');
            $table->string('qty_guest')->nullable()->comment('perkiraan jumlah tamu, its nullable');
            $table->string('reservation_payment_status')->comment('payment status for this reservation : Full, DP');
            $table->string('reservation_payment_method')->comment('payment method for this reservation : Cash, Bank Transfer, eWallet etc');
            $table->string('reservation_status')->comment('Status Reservation : Booked, Checked-in, Canceled, Expired');
            $table->string('reservation_desc')->nullable()->comment('Description of this reservation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
