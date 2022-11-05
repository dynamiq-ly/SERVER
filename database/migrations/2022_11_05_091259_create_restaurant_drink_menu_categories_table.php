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
        Schema::create('restaurant_drink_menu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_drink_category');
            $table->enum('restaurant_drink_type', ['SOFT', 'ALCOHOL']);
            $table->string('restaurant_drink_image');
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
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
        Schema::dropIfExists('restaurant_drink_menu_categories');
    }
};
