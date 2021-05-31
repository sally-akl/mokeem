<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MokeemPersonRelative extends Model
{
    protected $table = "mokeem_person_relative";
    protected $fillable =["person_id","relative_id"];
}
