<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PersonVisits;
use Session;
use Validator;

class VisitsController extends Controller
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
      $query = PersonVisits::selectraw("mokeem_person_visits.person_id , mokeem_person_visits.id as mid ,mokeem_person_visits.relative_id , mokeem_person_visits.visit_type ,mokeem_person_visits.visit_date_day ,mokeem_person_visits.visit_time ,mokeem_person_visits.visit_period ,mokeem_person_visits.visit_num ,mokeem_person_visits.visit_rakam,mokeem_person_visits.visit_date_month,mokeem_person_visits.visit_date_year")->join("mokeem_person","mokeem_person_visits.person_id","mokeem_person.id")->join("mokeem_relative","mokeem_person_visits.relative_id","mokeem_relative.id")->orderby("mokeem_person_visits.id","desc");
      if(isset($request->search))
      {
        if(isset($request->person_record))
          $query = $query->where('mokeem_person.person_num', $request->person_record);
        if(isset($request->person_name))
          $query = $query->where('mokeem_person.person_name', 'LIKE', '%'.$request->person_name.'%');
        if(isset($request->relative_name))
          $query = $query->where('mokeem_relative.relative_name', 'LIKE', '%'.$request->relative_name.'%');
      }
      $visits = $query->where("mokeem_person.is_archive",0)->get();
      return view('dashboard.visits.index',compact('visits'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('dashboard.visits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
                  'moken_select' => 'required',
                  'relative_select' => 'required',
                  'visit_type' => 'required',
                  'visite_date' => 'required',
                  'visite_time' => 'required',
                  'visite_num' => 'required',
                  'mar_rakam' => 'required',
      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());

      $visite = new PersonVisits();
      $visite->person_id  = $request->moken_select;
      $visite->relative_id  = $request->relative_select;
      $visite->visit_type = $request->visit_type;
      $visite->visit_date_day = explode("-",$request->visite_date)[2];
      $visite->visit_date_month = explode("-",$request->visite_date)[1];
      $visite->visit_date_year = explode("-",$request->visite_date)[0];
      $visite->visit_time = $request->visite_time;
      $visite->visit_period= $request->visite_period ;
      $visite->visit_num = $request->visite_num;
      $visite->visit_rakam = $request->mar_rakam;
      $visite->visite_date_ge = $request->visite_date;
      $visite->save();
      return redirect('dashboard/visit/')->with("message",trans('site.add_sucessfully'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $visit = PersonVisits::findOrFail($id);
      return view('dashboard.visits.update',compact('visit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
                  'moken_select' => 'required',
                  'relative_select' => 'required',
                  'visit_type' => 'required',
                  'visite_date' => 'required',
                  'visite_time' => 'required',
                  'visite_num' => 'required',
                  'mar_rakam' => 'required',
      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());

      $visite = PersonVisits::findOrFail($id);
      $visite->person_id  = $request->moken_select;
      $visite->relative_id  = $request->relative_select;
      $visite->visit_type = $request->visit_type;
      $visite->visit_date_day = explode("-",$request->visite_date)[2];
      $visite->visit_date_month = explode("-",$request->visite_date)[1];
      $visite->visit_date_year = explode("-",$request->visite_date)[0];
      $visite->visit_time = $request->visite_time;
      $visite->visit_period= $request->visite_period ;
      $visite->visit_num = $request->visite_num;
      $visite->visit_rakam = $request->mar_rakam;
      $visite->visite_date_ge = $request->visite_date;
      $visite->save();
      return redirect('dashboard/visit/')->with("message",trans('site.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $visit = PersonVisits::findOrFail($id);
      $visit->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }

    public function search_mokeem(Request $request)
    {
      $query = \App\MokeemPerson::where("is_archive",0);
      if(isset($request->person_record))
        $query = $query->where('person_num', $request->person_record);
      if(isset($request->person_name) && !empty($request->person_name))
        $query = $query->where('person_name', 'LIKE', '%'.$request->person_name.'%');

      $persons = $query->get();
      $html = "";
      foreach($persons as $person)
      {
        $html .='<option value="'.$person->id.'">'.$person->person_name.'</option>';
      }
      return $html;
    }
    public function search_relative(Request $request)
    {
      $query = \App\MokeemRelative::orderby("id","desc");
      if(isset($request->relative_record))
           $query = $query->where('relative_record', $request->relative_record);
      if(isset($request->relative_name) && !empty($request->relative_name))
            $query = $query->where('relative_name', 'LIKE', '%'.$request->relative_name.'%');
      $relivepersons = $query->get();
      $html = "";
      foreach($relivepersons as $relative)
      {
        $html .='<option value="'.$relative->id.'">'.$relative->relative_name.'</option>';
      }
      return $html;

    }
}
