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
        Schema::create('tour_agency_guides', function (Blueprint $table) {
            $table->id();
            $table->string('guide_name');
            $table->text('guide_about');
            $table->string('guide_phone');
            $table->string('guide_email');
            $table->string('guide_link');
            $table->string('guide_instagram');
            $table->string('guide_lang_spoken');
            $table->string('guide_image');
            $table->foreignId('agencies_id')->constrained('tour_agencies')->onDelete('cascade');
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
        Schema::dropIfExists('tour_agency_guides');
    }
};
