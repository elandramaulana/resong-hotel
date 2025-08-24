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
        Schema::table('late_point_settings', function (Blueprint $table) {
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_account_number', 100)->nullable();
            $table->string('bank_account_name', 100)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('late_point_settings', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_account_number');
            $table->dropColumn('bank_account_name');

        });
    }
};
