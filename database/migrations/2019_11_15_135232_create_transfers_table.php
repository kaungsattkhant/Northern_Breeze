<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('to_branch_id')->nullable();
            $table->unsignedBigInteger('from_branch_id')->nullable();
            $table->foreign('to_branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('date_time');
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
        Schema::dropIfExists('transfers');
    }
}
