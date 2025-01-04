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
        Schema::create('checkin_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('checkin_id');
            $table->string('item_category')->comment("Contains category of detail item that included into this customer bills");
            $table->string('item_name');
            $table->integer('item_price');
            $table->integer('item_qty');
            $table->text('item_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkin_details');
    }
};
