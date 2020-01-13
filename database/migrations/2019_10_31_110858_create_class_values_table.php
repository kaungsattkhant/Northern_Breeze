<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('value');
            $table->dateTime('date_time');
            $table->unsignedBigInteger('classification_group_id')->nullable();
            $table->foreign('classification_group_id')->references('id')->on('classification_group');
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
        Schema::dropIfExists('class_values');
    }
}
