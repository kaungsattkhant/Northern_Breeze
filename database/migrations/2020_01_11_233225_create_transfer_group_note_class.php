<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferGroupNoteClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_group_note_class', function (Blueprint $table) {
            $table->unsignedBigInteger('transfer_id');
            $table->unsignedBigInteger('group_note_id');
            $table->unsignedBigInteger('class_id');
            $table->integer('sheet');
            $table->foreign('class_id')->references('id')->on('classifications')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_note_id')->references('id')->on('group_note')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_group_note_class');
    }
}
