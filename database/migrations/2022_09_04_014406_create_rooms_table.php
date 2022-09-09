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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->string('room_floor');
            $table->integer('room_number');
            $table->text('room_descripton');
            $table->integer('room_space_area');

            $table->string('room_features');
            $table->integer('room_price');
            $table->enum('room_view', ['balcony', 'windowed', 'street', 'beatch', 'pool']);

            $table->integer('room_occupency_max');
            $table->integer('room_occupency_max_adult');
            $table->integer('room_occupency_max_children');
            $table->integer('room_occupency_max_guest');

            $table->boolean('room_child_crib')->default(false);
            $table->boolean('room_smoking')->default(false);
            $table->boolean('room_can_expend')->default(false);
            $table->boolean('room_status')->default(true);
            $table->foreignId('room_type_id')->constrained('room_types')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
};
