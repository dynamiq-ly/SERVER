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
        Schema::create('tour_agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agency_title');
            $table->string('agency_summary');
            $table->text('agency_description');
            $table->string('agency_website');
            $table->string('agency_image');
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
        Schema::dropIfExists('tour_agencies');
    }
};
