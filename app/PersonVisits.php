<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PersonVisits extends Model
{
    protected $table = "mokeem_person_visits";
    public function person()
    {
        return $this->belongsTo('App\MokeemPerson','person_id');
    }
    public function relative()
    {
        return $this->belongsTo('App\MokeemRelative','relative_id');
    }
}
