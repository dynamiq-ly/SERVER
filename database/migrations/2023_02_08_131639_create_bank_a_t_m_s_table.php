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
        Schema::create('bank_a_t_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('bank_description');
            $table->string('bank_location_textual');
            $table->string('bank_location_coords');
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
        Schema::dropIfExists('bank_a_t_m_s');
    }
};
