<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table)  {
            $table->increments('id');
            $table->string('log_name');
            $table->string('log_description')->nullable();
            $table->integer('duration');
            $table->string('status');
            $table->string('retrieved_from')->nullable;
            $table->boolean('is_group_log')
                  ->default(0);
            $table->string('priority');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('list_id')->unsigned()->index();
            $table->foreign('list_id')->references('id')->on('list')->onDelete('cascade');
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
        Schema::drop('log');
    }
}
