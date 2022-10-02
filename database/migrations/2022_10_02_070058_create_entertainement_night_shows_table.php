<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entertainement_night_shows', function (Blueprint $table) {
            $table->id();
            $table->string('night_show_web_link');
            $table->string('night_show_leader')->nullable();
            $table->string('night_show_assisatant')->nullable();
            $table->string('night_show_video_link')->nullable();
            $table->string('night_show_ticked_price')->nullable();
            $table->string('night_show_audience');
            $table->string('night_show_type');
            $table->timestamps();
            $table->foreignId('entertainements_id')->constrained('entertainements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entertainement_night_shows');
    }
};
