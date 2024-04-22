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
        Schema::table('laundry_cats', function (Blueprint $table) {
            $table->string('cat_unit')->after('cat_price')->comment('Contains Units of Category ext: Kg, Pcs, Pax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laundry_cats', function (Blueprint $table) {
            $table->dropColumn('cat_price');
        });
    }
};
