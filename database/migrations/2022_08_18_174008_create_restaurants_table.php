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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->string('restaurant_website');
            $table->text('restaurant_descripton');
            $table->string('restaurant_opens');
            $table->string('restaurant_closes');
            $table->string('restaurant_location');
            $table->string('restaurant_speciality');
            $table->boolean('restaurant_status')->default(true);
            $table->integer('restaurant_capacity')->default(30);
            $table->boolean('restaurant_can_book')->default(true);
            $table->string('restaurant_booked_capacity')->default(0);
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
        Schema::dropIfExists('restaurants');
    }
};
