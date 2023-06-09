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
        Schema::create('entertainements', function (Blueprint $table) {
            $table->id();
            $table->string('entertainement_name');
            $table->string('entertainement_summary');
            $table->string('entertainement_description');
            $table->enum('entertainement_type', ['SPORT', 'NIGHT', 'DAY', 'OTHER']);
            $table->enum('entertainement_age', ['KIDS', 'ADULTS', 'TEENS', 'FAMILY', 'OTHER']);
            $table->string('entertainement_location');
            $table->enum('entertainement_joinable', ['YES', 'NO', 'DEPENDS']);
            $table->boolean('isVisible')->default(true);
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
        Schema::dropIfExists('entertainements');
    }
};
