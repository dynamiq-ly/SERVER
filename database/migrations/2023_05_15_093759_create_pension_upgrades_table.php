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
        Schema::create('pension_upgrades', function (Blueprint $table) {
            $table->id();
            $table->string('pension_name');
            $table->string('pension_price');
            $table->string('pension_price_kids')->nullable();
            $table->string('pension_image');
            $table->string('pension_description');
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
        Schema::dropIfExists('pension_upgrades');
    }
};
