<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('late_point_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('first_late')->default(30);
            $table->integer('first_latepoint')->default(10);
            $table->integer('second_late')->nullable()->default(60);
            $table->integer('second_latepoint')->nullable()->default(20);
            $table->integer('third_late')->nullable()->default(120);
            $table->integer('third_latepoint')->nullable()->default(30);
            $table->float('besar_potongan')->default(1000);
            $table->integer('besar_point')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('late_point_settings');
    }
};
