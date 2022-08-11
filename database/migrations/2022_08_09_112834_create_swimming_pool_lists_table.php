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
        Schema::create('swimming_pool_lists', function (Blueprint $table) {
            $table->id();
            $table->string('pool_name');
            $table->string('pool_image');
            $table->string('pool_capacity');
            $table->text('pool_description');
            $table->boolean('pool_status')->default(true);
            $table->foreignId('pool_id')->constrained('swimming_pools')->onDelete('cascade');
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
        Schema::dropIfExists('swimming_pool_lists');
    }
};
