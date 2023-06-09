<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_location_parts', function (Blueprint $table) {
            $table->string('location_name')->unique();
            $table->string('location_description')->nullable();
            $table->enum('location_restriction', ['PUBLIC', 'PRIVATE', 'RESTRICTED', 'HIDDEN']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_location_parts');
    }
};
