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
        Schema::create('night_shows', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->string('name');
            $table->text('description');
            $table->string('genre');
            $table->boolean('visible')->default(true);
            $table->boolean('joinable')->default(false);

            $table->text('youtube_link')->nullable();
            $table->text('website_link')->nullable();

            $table->string('host_name')->nullable();
            $table->string('host_image')->nullable();
            $table->string('host_role')->nullable();
            $table->string('host_description')->nullable();

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
        Schema::dropIfExists('night_shows');
    }
};
