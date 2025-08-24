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
        Schema::table('guests', function (Blueprint $table) {
            $table->string('id_number', 100)->nullable()->change();
            $table->string('place_of_birth', 100)->nullable()->change();
            $table->string('guest_contact', 100)->nullable()->change();
            $table->string('guest_email', 100)->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->string('id_type', 100)->nullable()->change();
            $table->string('guest_title', 100)->nullable()->change();
            $table->string('guest_country', 100)->nullable()->change();
            $table->string('guest_province', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->string('id_number', 100)->nullable(false)->change();
            $table->string('place_of_birth', 100)->nullable(false)->change();
            $table->string('guest_contact', 100)->nullable(false)->change();
            $table->string('guest_email', 100)->nullable(false)->change();
            $table->string('guest_address', 100)->nullable(false)->change();
            $table->date('date_of_birth')->nullable(false)->change();
            $table->string('id_type', 100)->nullable(false)->change();
            $table->string('guest_title', 100)->nullable(false)->change();
            $table->string('guest_country', 100)->nullable(false)->change();
            $table->string('guest_province', 100)->nullable(false)->change();
        });
    }
};
