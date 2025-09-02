<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transaction_reports', function (Blueprint $table) {
            $table->decimal('besar_transaksi', 15, 2)->change(); // Mengubah ke decimal
        });
    }

    public function down()
    {
        Schema::table('transaction_reports', function (Blueprint $table) {
            $table->date('besar_transaksi')->change(); // Rollback ke tipe date jika perlu
        });
    }
};
