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
        Schema::create('report_incidents', function (Blueprint $table) {
            $table->id();
            $table->boolean('isAnswered')->default(false);
            $table->string('IncidentDate');
            $table->string('IncidentType');
            $table->string('IncidentLocation');
            $table->text('IncidentDescription');                                                               
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
        Schema::dropIfExists('report_incidents');
    }                    
};
                           
