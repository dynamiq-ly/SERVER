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
        Schema::create('room_requests', function (Blueprint $table) {
            $table->id();
            $table->string('room_request_title');
            $table->text('room_request_content');
            $table->string('room_request_room_number');
            $table->boolean('isAnsewred')->default(false);
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
        Schema::dropIfExists('room_requests');
    }
};
