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
        Schema::create('reminder_calls', function (Blueprint $table) {
            $table->id();
            $table->string('reminder_title');
            $table->string('reminder_date');
            $table->enum('reminder_priority', ['minor', 'normal', 'urgent'])->default('minor');
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
        Schema::dropIfExists('reminder_calls');
    }
};
