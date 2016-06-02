<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('uid')->unsigned();
			$table->foreign('uid')->references('id')->on('users');
			$table->string('title');
			$table->text('cover'); //封面
			$table->mediumtext('content'); //敘述
			$table->text('game'); //遊戲路徑
			$table->integer('status')->unsigned();
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
		Schema::drop('article');
	}

}
