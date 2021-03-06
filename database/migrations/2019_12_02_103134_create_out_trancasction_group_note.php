<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutTrancasctionGroupNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_transaction_group_note', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->unsignedBigInteger('group_note_id')->nullable();
//            $table->unsignedBigInteger('sell_group_value_id')->nullable();
            $table->string('out_classable_type');
            $table->unsignedBigInteger('out_classable_id');
            $table->integer('sheet');
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('sell_group_value_id')->references('id')->on('sell_group_values')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_note_id')->references('id')->on('group_note')->onDelete('cascade')->onUpdate('cascade');
//            $table->index(['out_classable_id','out_classable_type']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('out_transaction_group_note');
    }
}
