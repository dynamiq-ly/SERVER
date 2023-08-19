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
        Schema::create('bars_alcohol_drinks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');
            $table->string('slug');
            $table->string('size');
            $table->float('price');
            $table->float('small_price')->nullable();
            $table->string('category')->nullable();
            $table->enum('type', ['glass', 'bottle']);
            $table->text('served_slug')->nullable();
            $table->text('served_with')->nullable();
            $table->text('preperation')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('drink_id')->constrained('bars_menus')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bars_alcohol_drinks');
    }
};
