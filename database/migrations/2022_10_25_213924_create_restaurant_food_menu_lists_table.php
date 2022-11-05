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
        Schema::create('restaurant_food_menu_lists', function (Blueprint $table) {
            $table->id();
            $table->string('dish_name');
            $table->string('dish_summary');
            $table->string('dish_price');
            $table->text('dish_description');
            $table->string("dish_image");
            $table->integer('dish_discount')->max(100)->min(0)->default(0);
            $table->string('dish_ingredient');
            $table->string('dish_wait_time');
            $table->foreignId('restaurant_food_categories_id')->constrained('restaurant_food_menu_categories')->onDelete('cascade');
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
        Schema::dropIfExists('restaurant_food_menu_lists');
    }
};
