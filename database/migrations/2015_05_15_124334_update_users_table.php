<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->string('activation_code')->after('password');
			$table->boolean('active')->default(0)->after('activation_code');
			$table->tinyInteger('resent')->unsigned()->after('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('activation_code');
			$table->dropColumn('active');
			$table->dropColumn('resent');
		});
	}

}
