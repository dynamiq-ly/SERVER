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
        Schema::create('rooms_list_configs', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(true);
            $table->boolean('booking')->default(false);
            $table->float('upgrade-price')->nullable();
            $table->float('downgrade-price')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('room_id')->constrained('rooms_lists')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('rooms_list_configs');
    }
};
