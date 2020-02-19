<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyCustomClassGroupValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_custom_class_group_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('value');
            $table->dateTime('date_time');
            $table->unsignedBigInteger('classification_group_id');
            $table->foreign('classification_group_id')->references('id')->on('classification_group')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('buy_custom_class_group_values');
    }
}
