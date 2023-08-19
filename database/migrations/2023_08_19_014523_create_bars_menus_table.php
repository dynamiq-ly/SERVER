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
        Schema::create('bars_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');
            $table->enum('type', ['soft', 'alcohol']);
            $table->string('categories')->nullable();
            $table->foreignId('bar_id')->constrained('bars_lists')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('bars_menus');
    }
};
