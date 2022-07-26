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
        Schema::create('activity__lists', function (Blueprint $table) {
            $table->id();
            $table->string('activity_list_name');
            $table->string('activity_list_duration');
            $table->string('activity_list_thumbnail');
            $table->string('activity_list_description');
            $table->string('activity_list_meeting_point');
            $table->string('activity_list_required_equipment');
            $table->string('activity_list_zone');
            $table->foreignId('activities_id')->constrained('activities')->onDelete('cascade');
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
        Schema::dropIfExists('activity__lists');
    }
};
