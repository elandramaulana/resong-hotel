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
        Schema::create('trans_resto', function (Blueprint $table) {
            $table->id();
            $table->string('checkin_id')->nullable();
            $table->string('guest_name');
            $table->string('guest_contact');
            $table->string('guest_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trans_resto');
    }
};
