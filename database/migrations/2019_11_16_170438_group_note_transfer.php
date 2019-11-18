<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupNoteTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_note_transfer', function (Blueprint $table) {
            $table->unsignedBigInteger('transfer_id');
            $table->unsignedBigInteger('group_note_id')->nullable();
            $table->integer('sheet');
            $table->foreign('transfer_id')->references('id')->on('transfers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_note_id')->references('id')->on('group_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_note_transfer');
    }
}
