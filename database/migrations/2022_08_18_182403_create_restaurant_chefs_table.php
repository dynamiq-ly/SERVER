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
        Schema::create('restaurant_chefs', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_chef_exec_name');
            $table->string('restaurant_chef_exec_image');
            $table->string('restaurant_chef_name');
            $table->string('restaurant_chef_image');
            $table->timestamps();
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_chefs');
    }
};
