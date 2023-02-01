<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnleavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onleaves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->dateTime('timeStart');
            $table->dateTime('timeEnd');
            $table->text('reason');
            $table->text('ongoing')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('onleaves');
    }
}
