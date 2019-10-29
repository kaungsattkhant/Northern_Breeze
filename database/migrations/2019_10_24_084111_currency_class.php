<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CurrencyClass extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_class', function (Blueprint $table) {
//           $table->bigIncrements('id');
           $table->unsignedBigInteger('currency_id');
           $table->unsignedBigInteger('classification_id');
            $table->foreign('currency_id')->references('id')->on('currencies')->onUpdate('cascade')->onUpdate('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onUpdate('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_class');
    }
}
