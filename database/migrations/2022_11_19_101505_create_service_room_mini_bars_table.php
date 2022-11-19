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
        Schema::create('service_room_mini_bars', function (Blueprint $table) {
            $table->id();
            $table->string('mini_bar_item_name');
            $table->float('mini_bar_item_price');
            $table->enum('min_bar_item_type', ['alcohol', 'soft', 'snacks']);
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
        Schema::dropIfExists('service_room_mini_bars');
    }
};
