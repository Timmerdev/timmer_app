<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarHolidays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('calendar_holidays', function (Blueprint $table)  {
            $table->increments('id');
            $table->string('holiday_name');
            $table->integer('holiday_date_month');
            $table->integer('holiday_date_day');
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
        Schema::drop('calendar_holidays');
    
    }
}
