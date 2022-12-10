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
        Schema::create('food_service_plates', function (Blueprint $table) {
            $table->id();
            $table->string('plate_name');
            $table->string('plate_image');
            $table->text('plate_descripiton');
            $table->float('plate_price');
            $table->string('plate_variance');
            $table->foreignId('food_service_categories_id')->constrained('food_service_categories')->onDelete('cascade');
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
        Schema::dropIfExists('food_service_plates');
    }
};
