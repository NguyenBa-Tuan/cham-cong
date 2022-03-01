<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('user_id')->nullable();
            $table->bigInteger('basic_salary')->nullable();
            $table->integer('standard_date')->nullable();
            $table->bigInteger('daily_salary')->nullable();
            $table->integer('paid_leave')->nullable();
            $table->integer('overtime_date')->nullable();
            $table->bigInteger('overtime_salary')->nullable();
            $table->float('number_working_day')->nullable();
            $table->bigInteger('punish')->nullable();
            $table->bigInteger('bonus')->nullable();
            $table->float('overtime')->nullable();
            $table->bigInteger('hourly_overtime')->nullable();
            $table->bigInteger('bhxh')->nullable();
            $table->bigInteger('salary')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('payrolls');
    }
}
