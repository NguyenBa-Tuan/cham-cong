<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesheetsTable extends Migration
{
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedInteger('user_id');
            $table->string('data')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('timesheets');
    }
}
