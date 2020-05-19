<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownBuildingLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('town_building_level', function (Blueprint $table) {
            $table->unsignedBigInteger('town_id');
            $table->unsignedInteger('building_level_id');
            $table->dateTime('upgrade_time', 0);
            $table->primary(['town_id', 'building_level_id']);
            $table->foreign('town_id')
                ->references('id')->on('town')
                ->onDelete('restrict');
            $table->foreign('building_level_id')
                ->references('id')->on('building_level')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('town_building_level');
    }
}
