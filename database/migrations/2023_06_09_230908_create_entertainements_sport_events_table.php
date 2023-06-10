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
        Schema::create('entertainements_sport_events', function (Blueprint $table) {
            $table->id();
            $table->string('sport_type');
            $table->string('sport_event');
            $table->string('sport_event_image')->default('https://wallpapercave.com/wp/wp3006044.png');

            $table->string('sport_event_home_team');
            $table->string('sport_event_home_image');

            $table->string('sport_event_away_team')->nullable();
            $table->string('sport_event_away_image')->nullable();

            $table->foreignId('entertainement_id')->constrained('entertainements')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('entertainements_sport_events');
    }
};
