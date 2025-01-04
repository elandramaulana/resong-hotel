<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_no',5)->comment('contains room number ex: 007');
            $table->string('room_name',100)->comment('contains room name ex: Bougenvile');
            $table->string('room_type',30)->comment('contains room type ex: VIP, VVIP, LUXURY, PRESIDENT SUITE');
            $table->integer('room_capacity')->comment('contains Max Guest in this room ex: 2 Adult');
            $table->boolean('room_extrabed')->default(true)->comment('its used for flaging that room can be using extrabed or not');
            $table->integer('room_price')->comment('contains price for this room in one night ex: 500000');
            $table->enum('room_status', ['OCCUPIED', 'BOOKED', 'VACANT DIRTY', 'VACANT READY'])->comment('contains room status : OCCUPIED, BOOKED, VACANT DIRTY, VACANT');
            $table->string('bed_type', 50)->comment('contains bed type for this room : Double Bed, SINGLE BED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
