<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('full_job')->nullable();
            $table->string('half_job')->nullable();
            $table->string('ncl')->nullable();
            $table->string('np')->nullable();
            $table->string('kp')->nullable();
            $table->string('total')->nullable();
            $table->string('note')->nullable();
            $table->integer('month_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
