<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->double('accepted_hours', 8.2)->default(0)->nullable();
            $table->double('declined_hours', 8.2)->default(0)->nullable();
            $table->double('hours', 8.2)->default(0)->nullable();
            $table->boolean('bank')->default(0)->nullable();
            $table->double('multiply', 8.2)->default(0)->nullable();
            $table->double('mileage', 8.2)->default(0)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('trip_id')->references('id')->on('trips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_user');
    }
}
