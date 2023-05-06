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
        Schema::create('restaurant_reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('reservation_name');
            $table->integer('reservation_number_of_people');
            $table->string('reservation_date_time');
            $table->string('reservation_description');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_reservations');
    }
};
