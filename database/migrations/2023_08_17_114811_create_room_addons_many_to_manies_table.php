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
        Schema::create('room_addons_many_to_manies', function (Blueprint $table) {
            $table->id();
            $table->boolean('featured')->default(false);
            $table->foreignId('room_id')->constrained('rooms_lists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('addon_id')->constrained('rooms_list_ads_ons')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('room_addons_many_to_manies');
    }
};
