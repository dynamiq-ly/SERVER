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
        Schema::create('day_activities', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->string('name');
            $table->string('description');
            $table->string('location');
            $table->boolean('visible')->default(true);
            $table->boolean('joinable')->default(false);
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
        Schema::dropIfExists('day_activities');
    }
};
