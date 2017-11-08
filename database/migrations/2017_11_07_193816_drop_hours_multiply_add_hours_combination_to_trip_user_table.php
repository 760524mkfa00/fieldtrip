<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropHoursMultiplyAddHoursCombinationToTripUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trip_user', function (Blueprint $table) {
            $table->dropColumn(['hours', 'multiply']);

            $table->double('one', 8.2)->default(0)->nullable();
            $table->double('oneHalf', 8.2)->default(0)->nullable();
            $table->double('two', 8.2)->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_user', function (Blueprint $table) {
            //
        });
    }
}
