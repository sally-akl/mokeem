<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MokeemPerson;
use Session;
use Validator;

class ReportController extends Controller
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

    public function index($type,Request $request)
    {
      return view('dashboard.report.index',compact('type'));
    }
    public function visitcount_report($type,Request $request)
    {
      $query = MokeemPerson::selectraw("DISTINCT mokeem_person.person_name , mokeem_person.parent_type,sum(CASE WHEN visit_type = 'visit_out'  THEN 1 ELSE 0 END ) as vout , sum(CASE WHEN visit_type = 'visit_in'  THEN 1 ELSE 0 END ) as vn")
                                      ->leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                      ->orderBy("mokeem_person.id","desc")
                                      ->whereraw("is_archive = 0 and parent_type=".$type);

      if(isset($request->search))
      {
        if(isset($request->from_date) && isset($request->to_date))
        {
          $query = $query->orWhere(function ($query) use ($request) {
            $query->whereBetween('mokeem_person_visits.visite_date_ge', [$request->from_date, $request->to_date]);
          });
        }

      }
      $mokeem_persons = $query->groupby("mokeem_person.person_name")->get();
      return view('dashboard.report.visitcount',compact('mokeem_persons','type'));

    }
    public function visitmokeem_report($type,Request $request)
    {
      $query = \App\PersonVisits::join("mokeem_person","mokeem_person_visits.person_id","mokeem_person.id")
                                  ->join("mokeem_relative","mokeem_person_visits.relative_id","mokeem_relative.id")
                                  ->where("mokeem_person.is_archive",0)
                                  ->where("mokeem_person.parent_type",$type)
                                  ->orderby("mokeem_person_visits.id","desc");
      if(isset($request->search))
      {
        if(isset($request->from_date) && isset($request->to_date))
        {
        /*  $form_date_day = explode("-",$request->from_date)[2];
          $form_date_month = explode("-",$request->from_date)[1];
          $form_date_year = explode("-",$request->from_date)[0];

          $to_date_day = explode("-",$request->to_date)[2];
          $to_date_month = explode("-",$request->to_date)[1];
          $to_date_year = explode("-",$request->to_date)[0];
          */
          $query = $query->whereraw('(mokeem_person_visits.visite_date_ge between "'.$request->from_date.'" and "'.$request->to_date.'" )');
        }
        if(isset($request->mokeem_name))
          $query = $query->where("person_id",$request->mokeem_name);
      }
      $visits = $query->get();
      return view('dashboard.report.visitmokeem',compact('visits','type'));

    }
    public function relatives_report($type)
    {
      $query = \App\MokeemRelative::join("mokeem_person_relative","mokeem_person_relative.relative_id","mokeem_relative.id")
                                  ->join("mokeem_person","mokeem_person_relative.person_id","mokeem_person.id")
                                  ->where("mokeem_person.is_archive",0)
                                  ->where("mokeem_person.parent_type",$type)
                                  ->orderby("mokeem_relative.id","desc");
      $relivepersons = $query->get();
      return view('dashboard.report.relatives',compact('relivepersons','type'));
    }

}
