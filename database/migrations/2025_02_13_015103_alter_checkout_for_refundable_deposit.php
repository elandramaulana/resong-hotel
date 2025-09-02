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
        Schema::table('checkouts', function (Blueprint $table) {
            // $table->dropColumn('checkout_payment');
            // $table->dropColumn('discount');
            // $table->dropColumn('description');
            $table->boolean('refund_deposit')->after('checkin_id')->nullable()->change();
            $table->string('checkout_descriptions')->after('refund_deposit')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->double('checkout_payment');
            $table->double('discount');
            $table->string('description');
            $table->dropColumn('refund_deposit');
            $table->dropColumn('checkout_descriptions');
        });
    }
};
