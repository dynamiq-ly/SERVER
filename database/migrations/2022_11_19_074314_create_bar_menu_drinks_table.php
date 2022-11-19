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
        Schema::create('bar_menu_drinks', function (Blueprint $table) {
            $table->id();
            $table->string('bar_drink_name');
            $table->string('bar_drink_image')->nullable();
            $table->float('bar_drink_price');

            $table->integer('drink_bar_strengh')->default(0);
            $table->enum('drink_served_one', ['long glass', 'short glass', 'bottle', 'cans']);

            $table->string('bar_drink_served');
            $table->string('drink_main_alcohol')->nullable();
            $table->string('bar_drink_preperation')->nullable();
            $table->string('bar_drink_ingredient');
            $table->foreignId('menu_drink_id')->constrained('bar_menus')->onDelete('cascade');
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
        Schema::dropIfExists('bar_menu_drinks');
    }
};
