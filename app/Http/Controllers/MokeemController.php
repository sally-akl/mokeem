<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MokeemPerson;
use Session;
use Validator;

class MokeemController extends Controller
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
      $query = MokeemPerson::selectraw("mokeem_person.person_num ,mokeem_person.person_name ,mokeem_person.id , mokeem_person.building , mokeem_person.visiting_status  ,mokeem_person.birth_year")
                                      ->orderBy("mokeem_person.id","desc")
                                      ->where("parent_type",1)
                                      ->where("is_archive",0);

      if(isset($request->search))
      {
        if(isset($request->person_number))
           $query = $query->where('person_num', $request->person_number);
        if(isset($request->person_name))
            $query = $query->where('person_name', 'LIKE', '%'.$request->person_name.'%');
        if(isset($request->parent_name))
            $query = $query->where('parent_name', 'LIKE', '%'.$request->parent_name.'%');
      }
      $mokeem_persons = $query->get();
      $type_link = "boy/1";
      return view('dashboard.mokeem.index',compact('mokeem_persons','type_link','type'));
    }
    public function girl($type,Request $request)
    {
      $query = MokeemPerson::selectraw("mokeem_person.person_num ,mokeem_person.person_name ,mokeem_person.id , mokeem_person.building , mokeem_person.visiting_status ,mokeem_person.birth_year")
                                      ->orderBy("mokeem_person.id","desc")
                                      ->where("parent_type",2)
                                      ->where("is_archive",0);

      if(isset($request->search))
      {

        if(isset($request->person_number))
            $query = $query->where('person_num', $request->person_number);
        if(isset($request->person_name))
            $query = $query->where('person_name', 'LIKE', '%'.$request->person_name.'%');
        if(isset($request->parent_name))
            $query = $query->where('parent_name', 'LIKE', '%'.$request->parent_name.'%');
      }
      $mokeem_persons = $query->get();
      $type_link = "girl/2";
      return view('dashboard.mokeem.index',compact('mokeem_persons','type_link','type'));
    }
    public function move($id , $type)
    {
      $mokeem_person = MokeemPerson::findOrFail($id);
      $url="";
      if($type == 1)
      {
        $mokeem_person->parent_type = 2;
        $url="boy/".$type;
      }
      if($type == 2)
      {
        $mokeem_person->parent_type = 1;
        $url="girl/".$type;
      }
      $mokeem_person->save();
      return redirect('dashboard/mokeem/'.$url)->with("message",trans('site.move_sucessfully'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('dashboard.mokeem.create',compact('type'));
    }
    public function family($id)
    {
      $mokeem_person = MokeemPerson::findOrFail($id);
      return view('dashboard.mokeem.family',compact('mokeem_person','id'));
    }
    public function relation(Request $request)
    {
      $val = $request->val;
      $rec = $request->rec;
      $query =  \App\MokeemRelative::orderby("id","desc");
      if(!empty($val))
        $query = $query->where('mokeem_relative.relative_name', 'LIKE', '%'.$val.'%');
      if(!empty($rec))
        $query = $query->where('mokeem_relative.relative_record', $rec);
      $relatives = $query->get();
      $html = "";
      foreach($relatives as $k=>$relative)
      {
        $text = "relative_".$k;
        $text_hidden = "relative_hidden_".$k;
        $html .= "<tr>";
        $html .= "<td>".$relative->relative_record."</td>";
        $html .= "<td>".$relative->relative_name."</td>";
        $html .= "<td>".$relative->relative_phone."</td>";
        $html .= "<td>".$relative->relative_phone2."</td>";
        $html .= "<td>".$relative->relative_phone3."</td>";
        $html .= "<td><input type='text' name='".$text."' class='form-control' /></td>";
        $html .= "<td><input type='hidden' name='".$text_hidden."' value=".$relative->id." /></td>";
        $html .= "</tr>";
      }
      $html .= "<input type='hidden' name='relative_count' value='".count($relatives)."' class='form-control' />";
      echo $html;
    }
    public function save_relation(Request $request)
    {
      $relation_num = $request->relative_count;
      for($i=0;$i<$relation_num;$i++)
      {
        $relative_text = "relative_".$i;
        $relative_text_hidden = "relative_hidden_".$i;
        if(!empty($request->$relative_text))
        {
          $relation_person = \App\MokeemPersonRelative::firstOrNew(['person_id' => $request->person_data_id, 'relative_id' => $request->$relative_text_hidden]);
          $relation_person->relative_desc = $request->$relative_text;
          $relation_person->save();
        }

      }
      return redirect('dashboard/mokeem/'.$request->person_data_id.'/family/')->with("message",trans('site.add_sucessfully'));


    }
    public function archive(Request $request)
    {
      $validator = Validator::make($request->all(), [
             'archive_reason' => 'required',
             'archive_date' => 'required',
             'person_archive_id' => 'required',
      ]);
      if ($validator->fails())
        return json_encode(array("sucess"=>false ,"errors"=> $validator->errors()));
      $id = $request->person_archive_id;
      $mokeem_person = MokeemPerson::findOrFail($id);
      $mokeem_person->is_archive = 1;
      $mokeem_person->archive_reason = $request->archive_reason;
      $mokeem_person->archive_date_day = explode("-",$request->archive_date)[2];
      $mokeem_person->archive_date_month = explode("-",$request->archive_date)[1];
      $mokeem_person->archive_date_year = explode("-",$request->archive_date)[0];
      $mokeem_person->save();
      return json_encode(array("sucess"=>true,"sucess_text"=>trans('site.update_sucessfully')));
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
                  'person_num' => 'required|max:255|unique:mokeem_person',
                  'person_name' => 'required|max:255',
                  'birth_date' => 'required',
                  'person_record' => 'required|max:255|unique:mokeem_person',
                  'enter_date' => 'required',
                  'parent_record' => 'max:255|unique:mokeem_person',
                  'parent_name' => 'max:255',
                  'pdf1'=>'mimes:jpeg,jpg,png,gif,svg,pdf',
                  'pdf2'=>'mimes:jpeg,jpg,png,gif,svg,pdf',
                  'pdf3'=>'mimes:jpeg,jpg,png,gif,svg,pdf',

      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());

      $mokeem_person = new MokeemPerson();
      $mokeem_person->person_num = $request->person_num;
      $mokeem_person->person_name = $request->person_name;
      $mokeem_person->birth_day = explode("-",$request->birth_date)[2];
      $mokeem_person->birth_month = explode("-",$request->birth_date)[1];
      $mokeem_person->birth_year = explode("-",$request->birth_date)[0];
      $mokeem_person->person_record = $request->person_record;
      $mokeem_person->enter_date_day = explode("-",$request->enter_date)[2];
      $mokeem_person->enter_date_month = explode("-",$request->enter_date)[1];
      $mokeem_person->enter_date_year = explode("-",$request->enter_date)[0];
      $mokeem_person->building = $request->building;
      $mokeem_person->visiting_status = $request->visit_status;
      $mokeem_person->parent_record = $request->parent_record;
      $mokeem_person->parent_name = $request->parent_name;
      $mokeem_person->parent_relation = $request->relation;
      $mokeem_person->parent_address = $request->address;
      $mokeem_person->parent_phone = $request->phone_num;
      $mokeem_person->parent_work_address = $request->work_add;
      $mokeem_person->parent_type = $request->person_type;
      if(isset($request->pdf1))
      {
        $photo = $request->pdf1;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $mokeem_person->parent_pdf1 = "/img/profile/".$photo_name;
      }
      if(isset($request->pdf2))
      {
        $photo = $request->pdf2;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $mokeem_person->parent_pdf2 = "/img/profile/".$photo_name;
      }
      if(isset($request->pdf3))
      {
        $photo = $request->pdf3;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $mokeem_person->parent_pdf3 = "/img/profile/".$photo_name;
      }
      $mokeem_person->save();
      if(!empty($request->parent_record) && !empty($request->parent_name))
      {
        $relative = new \App\MokeemRelative();
        $relative->relative_record = $request->parent_record;
        $relative->relative_name = $request->parent_name;
        $relative->save();

        $relation_person = \App\MokeemPersonRelative::firstOrNew(['person_id' => $mokeem_person->id, 'relative_id' => $relative->id]);
        $relation_person->relative_desc = "الاب";
        $relation_person->save();
      }
      $url="";
      if($request->person_type == 1)
       $url="boy/".$request->person_type;
      if($request->person_type == 2)
       $url="girl/".$request->person_type;
      return redirect('dashboard/mokeem/'.$url)->with("message",trans('site.add_sucessfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $mokeem_person = MokeemPerson::findOrFail($id);
      return view('dashboard.mokeem.show',compact('mokeem_person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $mokeem_person = MokeemPerson::findOrFail($id);
      return view('dashboard.mokeem.update',compact('mokeem_person'));
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
                  'person_num' => 'required|max:255|unique:mokeem_person,person_num,'.$id,
                  'person_name' => 'required|max:255',
                  'birth_date' => 'required',
                  'person_record' => 'required|max:255|unique:mokeem_person,person_record,'.$id,
                  'enter_date' => 'required',
                  'parent_record' => 'max:255|unique:mokeem_person,parent_record,'.$id,
                  'parent_name' => 'max:255',
                  'pdf1'=>'mimes:jpeg,jpg,png,gif,svg,pdf',
                  'pdf2'=>'mimes:jpeg,jpg,png,gif,svg,pdf',
                  'pdf3'=>'mimes:jpeg,jpg,png,gif,svg,pdf',

      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());

      $mokeem_person = MokeemPerson::findOrFail($id);
      $old_name = $mokeem_person->parent_name;
      $old_rec = $mokeem_person->parent_record;


      $mokeem_person->person_num = $request->person_num;
      $mokeem_person->person_name = $request->person_name;
      $mokeem_person->birth_day = explode("-",$request->birth_date)[2];
      $mokeem_person->birth_month = explode("-",$request->birth_date)[1];
      $mokeem_person->birth_year = explode("-",$request->birth_date)[0];
      $mokeem_person->person_record = $request->person_record;
      $mokeem_person->enter_date_day = explode("-",$request->enter_date)[2];
      $mokeem_person->enter_date_month = explode("-",$request->enter_date)[1];
      $mokeem_person->enter_date_year = explode("-",$request->enter_date)[0];
      $mokeem_person->building = $request->building;
      $mokeem_person->visiting_status = $request->visit_status;
      $mokeem_person->parent_record = $request->parent_record;
      $mokeem_person->parent_name = $request->parent_name;
      $mokeem_person->parent_relation = $request->relation;
      $mokeem_person->parent_address = $request->address;
      $mokeem_person->parent_phone = $request->phone_num;
      $mokeem_person->parent_work_address = $request->work_add;
      if(isset($request->pdf1))
      {
        $photo = $request->pdf1;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $mokeem_person->parent_pdf1 = "/img/profile/".$photo_name;
      }
      if(isset($request->pdf2))
      {
        $photo = $request->pdf2;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $mokeem_person->parent_pdf2 = "/img/profile/".$photo_name;
      }
      if(isset($request->pdf3))
      {
        $photo = $request->pdf3;
        $photo_name = md5(rand(1,1000).time()).'.'.$photo->getClientOriginalExtension();
        $photo->move(public_path('/img/profile/'), $photo_name);
        $mokeem_person->parent_pdf3 = "/img/profile/".$photo_name;
      }
      $mokeem_person->save();
      if(!empty($request->parent_record) && !empty($request->parent_name))
      {
        $relative = \App\MokeemRelative::where('relative_record' ,$old_rec)->first();
        if($relative !== null)
        {
          $relative->relative_record = $request->parent_record;
          $relative->relative_name = $request->parent_name;
        }
        else{
          $relative = new \App\MokeemRelative();
          $relative->relative_record = $request->parent_record;
          $relative->relative_name = $request->parent_name;
        }
        $relative->save();

        $relation_person = \App\MokeemPersonRelative::firstOrNew(['person_id' => $mokeem_person->id, 'relative_id' => $relative->id]);
        $relation_person->relative_desc = "الاب";
        $relation_person->save();
      }
      $url="";
      if($mokeem_person->parent_type == 1)
       $url="boy/".$mokeem_person->parent_type;
      if($mokeem_person->parent_type == 2)
       $url="girl/".$mokeem_person->parent_type;
      return redirect('dashboard/mokeem/'.$url)->with("message",trans('site.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $mokeem_person = MokeemPerson::findOrFail($id);
      $mokeem_person->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }

    public function getrelatives($id)
    {
      $relatives = \App\MokeemRelative::selectraw("mokeem_relative.id as rid , mokeem_relative.relative_name")->join("mokeem_person_relative","mokeem_relative.id","relative_id")->where("person_id",$id)->get();
      $html = "";
      foreach ($relatives as $key => $relative)
      {
        $html .= "<option value='".$relative->rid."'>".$relative->relative_name."</option>";
      }
      return $html;
    }



}
