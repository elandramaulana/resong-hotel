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
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name_guest', 100);
            $table->string('id_number', 100);
            $table->date('date_of_birth');
            $table->string('place_of_birth', 100);
            $table->string('guest_gender', 100)->nullable();
            $table->string('guest_religion', 100)->nullable();
            $table->string('guest_title', 100);
            $table->string('guest_country', 100);
            $table->string('guest_province', 100);
            $table->string('guest_city', 100)->nullable();
            $table->string('guest_postalcode', 100)->nullable();
            $table->string('guest_email', 100);
            $table->string('guest_contact', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
