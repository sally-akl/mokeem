<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MokeemPerson extends Model
{
    protected $table = "mokeem_person";
    public function visites()
    {
      return $this->hasMany('App\PersonVisits','person_id');
    }
}
