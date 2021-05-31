<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MokeemPerson;
use Session;
use Validator;

class ArchiveController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $pagination_num = 10;
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      $query = MokeemPerson::orderBy("mokeem_person.id","desc")->where("is_archive",1);

      $mokeem_persons = $query->paginate($this->pagination_num);
      return view('dashboard.archive.index',compact('mokeem_persons'));
    }

}
