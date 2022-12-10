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
        Schema::create('food_service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('food_service_name')->unique();
            $table->string('food_service_opens');
            $table->string('food_service_closes');
            $table->string('food_service_min_order');
            $table->text('food_service_description');
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
        Schema::dropIfExists('food_service_categories');
    }
};
