<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MokeemPersonRelative extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mokeem_person_relative', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger("person_id")->unsigned();
          $table->foreign('person_id')->references('id')->on('mokeem_person')->onDelete('cascade');
          $table->bigInteger("relative_id")->unsigned();
          $table->foreign('relative_id')->references('id')->on('mokeem_relative')->onDelete('cascade');
          $table->text('relative_desc');
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
        //
    }
}
