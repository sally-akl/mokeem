<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MokeemRelative extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mokeem_relative', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('relative_record');
          $table->string('relative_name');
          $table->string('relative_phone');
          $table->string('relative_phone2');
          $table->string('relative_phone3');
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
      Schema::dropIfExists('mokeem_relative');
    }
}
