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
        Schema::create('laundries', function (Blueprint $table) {
            $table->id();
            $table->string('laundry_type')->comment('contains type transaction of the landry jobs, such as guest linen or uniforms personel');
            $table->string('checkin_id')->nullable()->comment('its only gona filled if type laundry is guest');
            $table->string('laundry_status')->comment('Status of the Laundry Jobs: New, Washing, Finishing, Done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundries');
    }
};
