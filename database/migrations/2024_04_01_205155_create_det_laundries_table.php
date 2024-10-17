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
        Schema::create('det_laundries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laundry_id')->comment('flaging laundry');
            $table->unsignedBigInteger('id_category')->comment('flaging category laundry');
            $table->integer('det_laundry_price')->comment('price for each category, its gona set 0 if type laundry linen/uniforms');
            $table->integer('det_laundry_qty');
            $table->text('det_laundry_desc')->nullable()->comment('its contains description of each category if exist');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_laundries');
    }
};
