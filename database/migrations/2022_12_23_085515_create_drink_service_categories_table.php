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
        Schema::create('drink_service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('drink_drink_category');
            $table->enum('drink_drink_type', ['SOFT', 'ALCOHOL']);
            $table->string('drink_drink_image');
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
        Schema::dropIfExists('drink_service_categories');
    }
};
