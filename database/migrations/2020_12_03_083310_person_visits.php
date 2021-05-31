<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonVisits extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mokeem_person_visits', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger("person_id")->unsigned();
          $table->foreign('person_id')->references('id')->on('mokeem_person')->onDelete('cascade');
          $table->bigInteger("relative_id")->unsigned();
          $table->foreign('relative_id')->references('id')->on('mokeem_relative')->onDelete('cascade');
          $table->string('visit_type');
          $table->timestamp('visit_date')->nullable();
          $table->string('visit_time');
          $table->string('visit_period')->nullable();
          $table->string('visit_num');
          $table->string('visit_rakam');
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
