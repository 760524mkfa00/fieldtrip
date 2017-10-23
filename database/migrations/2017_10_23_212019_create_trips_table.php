<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('field_trip_number')->unique();
            $table->dateTime('trip_date');
            $table->time('pickup_time');
            $table->string('pickup_location');
            $table->time('dropoff_time')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->integer('student_count');
            $table->string('fieldtrip_notes')->nullable();
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
        Schema::dropIfExists('trips');
    }
}
