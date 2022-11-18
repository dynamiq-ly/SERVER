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
        Schema::create('restaurant_drink_menu_alchohols', function (Blueprint $table) {
            $table->id();
            $table->string('drink_alcohol_name');

            $table->string('drink_alcohol_type');

            $table->string('drink_alcohol_bottle_size');
            $table->float('drink_alcohol_bottle_price');

            $table->string('drink_alcohol_glass_size');
            $table->float('drink_alcohol_glass_price');

            $table->text('drink_alcohol_description');

            $table->string('drink_alcohol_origin');
            $table->integer('drink_alcohol_year')->min(1000);

            $table->string('drink_alcohol_ingredient');
            $table->string('drink_alcohol_percentage');

            $table->string('drink_alcohol_image');
            $table->foreignId('restaurant_alcohol_id')->constrained('restaurant_drink_menu_categories')->onDelete('cascade');
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
        Schema::dropIfExists('restaurant_drink_menu_alchohols');
    }
};
