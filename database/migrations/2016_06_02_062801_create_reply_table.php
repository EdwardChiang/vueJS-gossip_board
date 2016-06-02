<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('uid')->unsigned();
			$table->foreign('uid')->references('id')->on('users');
			$table->integer('aid')->unsigned();
			$table->foreign('aid')->references('id')->on('article');
			$table->string('title');
			$table->string('content_txt'); //文字回覆內容
			$table->text('content_img')->unllable(); //塗鴉（可null）
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
		Schema::drop('reply');
	}

}
