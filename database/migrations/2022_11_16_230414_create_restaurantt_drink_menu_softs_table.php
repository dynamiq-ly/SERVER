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
        Schema::create('restaurant_drink_menu_softs', function (Blueprint $table) {
            $table->id();
            $table->string('soft_drink_name');
            $table->float('soft_drink_price');
            $table->string('soft_drink_variants');
            $table->foreignId('restaurant_soft_drink_id')->constrained('restaurant_drink_menu_categories')->onDelete('cascade');
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
        Schema::dropIfExists('restaurantt_drink_menu_softs');
    }
};
