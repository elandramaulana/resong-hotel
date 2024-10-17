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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('checkin_id')->comment('fk for checkin table');
            $table->string('checkout_payment')->comment('method payment for checkout');
            $table->integer('discount')->nullable(true)->comment('besar discount dalam percent');
            $table->text('description')->nullable(true)->comment('Keterangan untuk checkout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
