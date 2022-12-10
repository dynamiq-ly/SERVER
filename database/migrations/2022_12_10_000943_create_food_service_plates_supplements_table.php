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
        Schema::create('food_service_plates_supplements', function (Blueprint $table) {
            $table->id();
            $table->string('supplement_name');
            $table->string('supplement_price');
            $table->foreignId('food_service_plates_id')->constrained('food_service_plates')->onDelete('cascade');
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
        Schema::dropIfExists('food_service_plates_supplements');
    }
};
