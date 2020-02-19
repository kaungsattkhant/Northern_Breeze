<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name',120);
            $table->char('company',120);
            $table->date('date_of_birth');
            $table->text('address');
            $table->char('phone_number',45);
            $table->char('email',45);
            $table->integer('points');
            $table->unsignedBigInteger('member_type_id');
            $table->unsignedBigInteger('exchange_type_id');
            $table->foreign('member_type_id')->references('id')->on('member_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('exchange_type_id')->references('id')->on('exchange_types')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('members');
    }
}
