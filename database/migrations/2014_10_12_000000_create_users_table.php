<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
			$table->increments('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('route_id')->unsigned()->nullable();
            $table->string('other_job_posted', 20)->nullable();
            $table->string('driver_notes')->nullable();
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
