<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MokeemPerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('mokeem_person', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('person_num');
          $table->string('person_name');
          $table->string('birth_day');
          $table->string('birth_month');
          $table->string('birth_year');
          $table->string('person_record');
          $table->string('enter_date_day')->nullable();
          $table->string('enter_date_month')->nullable();
          $table->string('enter_date_year')->nullable();
          $table->string('building');
          $table->string('visiting_status');
          $table->string('parent_record');
          $table->string('parent_name');
          $table->string('parent_relation');
          $table->string('parent_address');
          $table->string('parent_phone');
          $table->string('parent_work_address');
          $table->string('parent_pdf1');
          $table->string('parent_pdf2');
          $table->string('parent_pdf3');
          $table->integer('is_archive')->default(0);
          $table->string('parent_type');
          $table->string('archive_reason')->nullable();
          $table->string('archive_date_day')->nullable();
          $table->string('archive_date_month')->nullable();
          $table->string('archive_date_year')->nullable();
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
        Schema::dropIfExists('mokeem_person');
    }
}
