<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInTrancasctionGroupNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_transaction_group_note', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('group_note_id')->nullable();
//            $table->unsignedBigInteger('buy_group_value_id')->nullable();
//            $table->morphs('in_classble');
            $table->string('in_classable_type');
            $table->unsignedBigInteger('in_classable_id');
            $table->integer('sheet');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('buy_group_value_id')->references('id')->on('buy_group_values')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_note_id')->references('id')->on('group_note')->onDelete('cascade')->onUpdate('cascade');
//            $table->index(['in_classable_id','in_classable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('in_transaction_group_note');
    }
}
