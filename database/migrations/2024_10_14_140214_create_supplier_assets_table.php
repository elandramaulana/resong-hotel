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
        Schema::create('supplier_assets', function (Blueprint $table) {
            $table->id();
            $table->string('id_supplier');
            $table->string('supplier_name');
            $table->string('supplier_telp');
            $table->string('supplier_alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_assets');
    }
};
