<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOverTimeHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtime_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('overtime_id');
            $table->unsignedInteger('user_id');
            $table->date('date');
            $table->dateTime('checkin');
            $table->dateTime('checkout');
            $table->time('totalTime');
            $table->string('projectName');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('overtime_histories');
    }
}
