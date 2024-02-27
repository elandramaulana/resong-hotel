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
            $table->string('reservation_chanel')->description('contains chanel reservation via Phone, Traveloka, etc');
            $table->date('reservation_date')->description('date reservation received');
            $table->date('reservation_checkin')->description('date checkin reservation');
            $table->date('reservation_checkout')->description('date checkout resevation');
            $table->boolean('reschedulable')->default(false)->description('is this reservation can be reschedule ?x ');
            $table->string('reservation_name')->description('name of reservation');
            $table->string('reservation_contact')->description('contact reservation');
            $table->string('reservation_email')->nullable()->description('email reservation, its nullable');
            $table->string('qty_guest')->nullable()->description('perkiraan jumlah tamu, its nullable');
            $table->string('reservation_payment_status')->description('payment status for this reservation : Full, DP');
            $table->string('reservation_payment_method')->description('payment method for this reservation : Cash, Bank Transfer, eWallet etc');
            $table->string('reservation_status')->description('Status Reservation : Booked, Checked-in, Canceled, Expired');
            $table->string('reservation_desc')->nullable()->description('Description of this reservation');
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
