<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('todo_id')->unsigned();
            $table->string('title');
            $table->date('deadline');
            $table->boolean('enabled');
            $table->timestamps();

            $table->foreign('todo_id') // このidを紐付け
                  ->references('id') // idを参照だよ
                  ->on('todos') // todosのだよ
                  ->onDelete('cascade'); //todo削除でpostsも消える よ
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
