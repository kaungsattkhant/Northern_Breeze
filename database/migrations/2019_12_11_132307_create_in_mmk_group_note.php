<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInMmkGroupNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_MMK_group_note', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('group_note_id')->nullable();
            $table->integer('sheet');
            $table->foreign('group_note_id')->references('id')->on('group_note')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_MMK_group_note');
    }
}
