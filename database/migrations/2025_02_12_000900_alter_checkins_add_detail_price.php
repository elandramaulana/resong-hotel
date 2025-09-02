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
        Schema::table('checkins', function (Blueprint $table) {
            $table->double('tax_price')->default(0)->after('payment_method');
            $table->double('extrabed_price')->default(0)->after('tax_price');
            $table->double('deposit')->default(0)->after('extrabed_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->dropColumn('tax_price');
            $table->dropColumn('extrabed_price');
            $table->dropColumn('deposit');
        });
    }
};
