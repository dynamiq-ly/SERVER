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
            $table->string('entertainements_title');
            $table->enum('entertainements_type', ['day activities', 'night shows', 'tv sport program', 'event programs']);
            $table->string('entertainements_summary');
            $table->string('entertainements_duration');
            $table->string('entertainements_description');
            $table->string('entertainements_location');
            $table->boolean('entertainements_location_can_join')->default(false);
            $table->boolean('entertainements_status')->default(true);
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
