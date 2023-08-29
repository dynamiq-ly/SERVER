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
        Schema::create('sport_programs', function (Blueprint $table) {
            $table->id();
            $table->boolean('lots_teams')->default(false);

            $table->string('location');
            $table->string('category');

            $table->string('day');
            $table->string('start_time');
            $table->string('end_time');

            $table->string('slug');
            $table->text('banner_image')->nullable();


            $table->string('home_team_name')->nullable();
            $table->text('home_team_logo')->nullable();

            $table->string('away_team_name')->nullable();
            $table->text('away_team_logo')->nullable();

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
        Schema::dropIfExists('sport_programs');
    }
};
