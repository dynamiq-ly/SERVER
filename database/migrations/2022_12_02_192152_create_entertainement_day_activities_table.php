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
        Schema::create('entertainement_day_activities', function (Blueprint $table) {
            $table->id();
            $table->enum('day_activity_rated', ['ADULTS', 'TEENS', 'FAMILIES', 'KIDS']);
            $table->foreignId('entertainements_id')->constrained('entertainements')->onDelete('cascade');
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
        Schema::dropIfExists('entertainement_day_activities');
    }
};
