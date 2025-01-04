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
        Schema::table('karyawan_has_divisions', function (Blueprint $table) {
            $table->boolean('khd_ot_approval')->default(false)->after('khr_tglOut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('karyawan_has_divisions', function (Blueprint $table) {
            $table->dropColumn('khd_ot_approval');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
};
