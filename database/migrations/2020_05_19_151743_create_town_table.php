<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('town', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name', 20)->default('NoName');
            $table->unsignedInteger('food')->default(0);
            $table->unsignedInteger('wood')->default(0);
            $table->unsignedInteger('stone')->default(0);
            $table->unsignedInteger('gold')->default(0);
            $table->dateTime('last_checked', 0)->useCurrent();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('town');
    }
}
