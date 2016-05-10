<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $request) {
            $request->increments('id');
            $request->integer('user_id')->unsigned()->index();
            $request->integer('project_id')->unsigned()->index();
            $request->integer('status')->unsigned()->index();
            $request->string('title');
            $request->string('description');
            $request->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
