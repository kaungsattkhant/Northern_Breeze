<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrasferClassGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_class_group', function (Blueprint $table) {
            $table->unsignedBigInteger('transfer_id');
            $table->unsignedBigInteger('classification_group_id');
            $table->double('value');
            $table->foreign('classification_group_id')->references('id')->on('classification_group')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('transfer_class_group');
    }
}
