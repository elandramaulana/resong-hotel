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
            $table->string('payroll_period')->default('25')->after('besar_point');
            $table->double('ot_price')->default(0)->after('payroll_period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('late_point_settings', function (Blueprint $table) {
            $table->removeColumn('payroll_period');
            $table->removeColumn('ot_price');
        });
    }
};
