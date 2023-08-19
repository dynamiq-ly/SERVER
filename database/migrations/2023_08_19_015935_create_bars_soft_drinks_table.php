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
        Schema::create('bars_soft_drinks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->text('ingredients');
            $table->foreignId('drink_id')->constrained('bars_menus')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bars_soft_drinks');
    }
};