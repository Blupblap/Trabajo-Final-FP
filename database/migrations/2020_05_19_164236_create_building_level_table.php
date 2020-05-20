<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_level', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('building_id');
            $table->integer('level');
            $table->integer('food_per_minute');
            $table->integer('wood_per_minute');
            $table->integer('stone_per_minute');
            $table->integer('gold_per_minute');
            $table->integer('required_food');
            $table->integer('required_wood');
            $table->integer('required_stone');
            $table->integer('required_gold');
            $table->integer('level_town_hall');
            $table->integer('power');
            $table->text('sprite')->nullable();
            $table->integer('upgrade_duration');
            $table->foreign('building_id')
                ->references('id')->on('building')
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
        Schema::dropIfExists('building_level');
    }
}
