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
        Schema::create('laundry_cats', function (Blueprint $table) {
            $table->id();
            $table->string('catergory_name')->comment('Contains Name of laundry categories');
            $table->integer('cat_price')->comment('contains price of category laundry, its gone null if non comersial laundry (linen/Uniform type laundry)');
            $table->string('cat_desc')->comment('contains description of categories laundry Exp : Untuk Laundry Jas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundry_cats');
    }
};
