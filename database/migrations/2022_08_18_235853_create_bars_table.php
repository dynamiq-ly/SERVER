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
        Schema::create('bars', function (Blueprint $table) {
            $table->id();
            $table->string('bar_name');
            $table->string('bar_location');
            $table->text('bar_description');
            $table->string('bar_open_time');
            $table->string('bar_closed_days');
            $table->string('bar_phone_number');
            $table->boolean('bar_status')->default(true);
            $table->boolean('bar_can_book')->default(true);
            $table->integer('bar_booking_capacity')->default(34);
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
        Schema::dropIfExists('bars');
    }
};
