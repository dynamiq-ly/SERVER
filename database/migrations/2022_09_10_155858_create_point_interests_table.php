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
        Schema::create('point_interests', function (Blueprint $table) {
            $table->id();
            $table->string('point_title');
            $table->string('point_small_summary');
            $table->text('point_description');
            $table->string('point_contact_number');
            $table->string('point_website_information');
            $table->string('point_textual_location');
            $table->string('point_cords_location');
            $table->string('point_recommended_visit');
            $table->boolean('point_status')->default(true);
            $table->foreignId('point_interest_types_id')->constrained('point_interest_types')->onDelete('cascade');
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
        Schema::dropIfExists('point_interests');
    }
};
