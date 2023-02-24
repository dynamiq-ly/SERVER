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
        Schema::create('laundry_menus', function (Blueprint $table) {
            $table->id();
            $table->float('clothes_type');
            $table->float('laundry') ->nullable();
            $table->float('dry_cleaning')->nullable();
            $table->float('pressing')->nullable();
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
        Schema::dropIfExists('laundry_menus');
    }
};
