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
			$table->foreign('aid')->references('id')->on('articles');
			$table->string('title');
			$table->string('content'); //文字回覆內容
			$table->text('content_img')->unllable(); //塗鴉（可null）
			$table->integer('status')->unsigned();
			$table->rememberToken();
			//$table->timestamps();
			$table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
			$table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
