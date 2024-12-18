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
        Schema::table('over_times', function (Blueprint $table) {
            $table->string('ot_reason_reject')->nullable()->after('ot_approvedBy');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('over_times', function (Blueprint $table) {
            $table->dropColumn('ot_reason_reject');
        });
    }
};
