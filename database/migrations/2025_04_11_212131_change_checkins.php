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
            $table->double('deposit')->nullable()->change();
            $table->enum('deposit_type', ['Cash', 'Lain-lain'])->nullable()->after('deposit');
            $table->string('deposit_lain')->nullable()->after('deposit_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->double('deposit')->change();
            $table->dropColumn('deposit_type');
            $table->dropColumn('deposit_lain');
        });
    }
};
