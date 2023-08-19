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
        Schema::create('bars_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->text('location');
            $table->string('phone_number');
            $table->text('description');
            $table->string('timing_open');
            $table->string('timing_close');

            $table->boolean('reservation_required')->default(false);
            $table->boolean('adults_only')->default(false);

            $table->text('menu_a_la_carte')->nullable();


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
        Schema::dropIfExists('bars_lists');
    }
};
