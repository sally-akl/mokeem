<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MokeemRelative;
use Session;
use Validator;

class RelativeController extends Controller
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
      $query = MokeemRelative::orderby("id","desc");
      if(isset($request->search))
      {
        if(isset($request->relative_record))
           $query = $query->where('relative_record', $request->relative_record);
        if(isset($request->relative_name))
            $query = $query->where('relative_name', 'LIKE', '%'.$request->relative_name.'%');
      }
      $relivepersons = $query->get();
      return view('dashboard.relative.index',compact('relivepersons'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.relative.create');
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
                  'relative_record' => 'required|max:255|unique:mokeem_relative',
                  'relative_name' => 'required|max:255',
                  'relative_phone' => 'required',
      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());

      $relative = new MokeemRelative();
      $relative->relative_record = $request->relative_record;
      $relative->relative_name = $request->relative_name;
      $relative->relative_phone = $request->relative_phone;
      $relative->relative_phone2 = $request->relative_phone2;
      $relative->relative_phone3 = $request->relative_phone3;
      $relative->save();
      return redirect('dashboard/relative/')->with("message",trans('site.add_sucessfully'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $relative = MokeemRelative::findOrFail($id);
      return view('dashboard.relative.update',compact('relative'));
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
                  'relative_record' => 'required|max:255|unique:mokeem_relative,relative_record,'.$id,
                  'relative_name' => 'required|max:255',
                  'relative_phone' => 'required',
      ]);
      if ($validator->fails())
        return back()->withInput()->withErrors($validator->errors());

      $relative = MokeemRelative::findOrFail($id);
      $relative->relative_record = $request->relative_record;
      $relative->relative_name = $request->relative_name;
      $relative->relative_phone = $request->relative_phone;
      $relative->relative_phone2 = $request->relative_phone2;
      $relative->relative_phone3 = $request->relative_phone3;
      $relative->save();
      return redirect('dashboard/relative/')->with("message",trans('site.update_sucessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $relative = MokeemRelative::findOrFail($id);
      $relative->delete();
      Session::put('message', trans('site.delete_sucessfully'));
      return json_encode(array("sucess"=>true));
    }
}
