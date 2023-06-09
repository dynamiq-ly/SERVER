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
        Schema::create('entertainements_night_shows', function (Blueprint $table) {
            $table->id();
            $table->float('night_show_price')->nullable();
            $table->integer('night_show_tickets')->nullable();
            $table->string('night_show_link')->nullable();
            $table->string('night_show_video')->nullable();
            $table->string('night_show_genre')->nullable();
            $table->string('night_show_performers')->nullable();
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
        Schema::dropIfExists('entertainements_night_shows');
    }
};
