@extends('dashboard.layouts.master')
@section('content')

<div class="card visit_div">

  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    @include("dashboard.utility.error_messages")
    <form method="POST" action="{{ url('dashboard/visit') }}/{{$visit->id}}" class="form-horizontal" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col col-md-6">
           <div class="row">
             <div class="col col-md-12" style="text-align: center;">
               <label for="text-input" class=" form-control-label">المقيم</label>
             </div>
           </div>
           <div class="row">
             <div class="col col-md-12">
               <select name="moken_select" class="form-control" multiple>
                 @foreach(\App\MokeemPerson::where("is_archive",0)->get() as $person)
                   <option value="{{$person->id}}" {{$visit->person_id  == $person->id?"selected":""}}>{{$person->person_name}}</option>
                 @endforeach
               </select>
             </div>
           </div>


        </div>
        <div class="col col-md-6">
          <div class="row">
            <div class="col col-md-12" style="text-align: center;">
              <label for="text-input" class=" form-control-label">القريب</label>
            </div>
          </div>
          <div class="row">
            <div class="col col-md-12">
              <select name="relative_select" class="form-control" multiple>
                @foreach(\App\MokeemRelative::all() as $relative)
                  <option value="{{$relative->id}}" {{$visit->relative_id   == $relative->id?"selected":""}}>{{$relative->relative_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-6">
          <div class="row search_area" style="border-left: none;">
            <div class="col col-md-12">
              <div class="row">
                <div class="col col-md-6">
                  البحث
                </div>
                <div class="col col-md-6" style="text-align: left;">
                  <button type="button" class="btn btn-primary btn-sm search_one">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col col-md-12">
                  <div class="row">
                    <div class="col col-md-12" style="text-align: center;">
                      <label for="text-input" class=" form-control-label">رقم المستفيد</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-12">
                      <input type="text"  name="search_person_record" placeholder="" value="" class="form-control ">
                    </div>
                  </div>
              </div>
              </div>
              <div class="row">
                <div class="col col-md-12">
                  <div class="row">
                    <div class="col col-md-12" style="text-align: center;">
                      <label for="text-input" class=" form-control-label">اسم المقيم</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-12">
                      <input type="text"  name="search_person_name" placeholder="" value="" class="form-control ">
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
        <div class="col col-md-6">
          <div class="row search_area">
            <div class="col col-md-12">
              <div class="row">
                <div class="col col-md-6">
                  البحث
                </div>
                <div class="col col-md-6" style="text-align: left;">
                  <button type="button" class="btn btn-primary btn-sm search_two">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col col-md-12">
                  <div class="row">
                    <div class="col col-md-12" style="text-align: center;">
                      <label for="text-input" class=" form-control-label">رقم السجل المدنى</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-12">
                      <input type="text"  name="search_relative_record" placeholder="" value="" class="form-control ">
                    </div>
                  </div>
              </div>
              </div>
              <div class="row">
                <div class="col col-md-12">
                  <div class="row">
                    <div class="col col-md-12" style="text-align: center;">
                      <label for="text-input" class=" form-control-label">اسم القريب</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col col-md-12">
                      <input type="text"  name="search_relative_name" placeholder="" value="" class="form-control ">
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>


      <div class="row form-group row_t">
        <div class="col col-md-2"><label for="text-input" class=" form-control-label">نوع الزيارة</label></div>
        <div class="col-12 col-md-6">
          <select name="visit_type" class="form-control">
            <option value="visit_in" {{$visit->visit_type == "visit_in"?"selected":""}}>داخلية</option>
            <option value="visit_out" {{$visit->visit_type == "visit_out"?"selected":""}}>خارجية</option>
          </select>
      </div>
      </div>
      <div class="row form-group row_t">
        <div class="col col-md-2"><label for="text-input" class=" form-control-label">تاريخ الزيارة</label></div>
        <div class="col-12 col-md-6">
          <input type="text"  name="visite_date" placeholder="" value="{{ $visit->visit_date_year.'-'.$visit->visit_date_month.'-'.$visit->visit_date_day }}" class="form-control {{ $errors->has('visite_date') ? ' is-invalid' : '' }}">
      </div>
      </div>
      <div class="row form-group row_t">
        <div class="col col-md-2"><label for="text-input" class=" form-control-label">وقت الزيارة</label></div>
        <div class="col-12 col-md-6">
          <input type="text"  name="visite_time" placeholder="" value="{{$visit->visit_time }}" class="form-control {{ $errors->has('visite_time') ? ' is-invalid' : '' }}">
      </div>
      </div>
      <div class="row form-group row_t">
        <div class="col col-md-2"><label for="text-input" class=" form-control-label">مدة الزيارة</label></div>
        <div class="col-12 col-md-6">
          <input type="text"  name="visite_period" placeholder="" value="{{ $visit->visit_period }}" class="form-control " {{$visit->visit_type == "visit_in"?"disabled":""}} >
      </div>
      </div>
      <div class="row form-group row_t">
        <div class="col col-md-2"><label for="text-input" class=" form-control-label">عدد الزائرين</label></div>
        <div class="col-12 col-md-6">
          <input type="text"  name="visite_num" placeholder="" value="{{ $visit->visit_num }}" class="form-control {{ $errors->has('visite_num') ? ' is-invalid' : '' }}">
      </div>
      </div>
      <div class="row form-group row_t">
        <div class="col col-md-2"><label for="text-input" class=" form-control-label">الرقم المرجعى</label></div>
        <div class="col-12 col-md-6">
          <input type="text"  name="mar_rakam" placeholder="" value="{{ $visit->visit_rakam }}" class="form-control {{ $errors->has('mar_rakam') ? ' is-invalid' : '' }}">
      </div>
      </div>

      <button type="submit" class="btn btn-primary btn-lg submit_btn">
        <i class="fa fa-dot-circle-o"></i> حفظ
      </button>
  </form>

  </div>

</div>

@endsection
@section('footerjscontent')
<script type="text/javascript">
$("input[name='visite_date']").hijriDatePicker({
             hijri:true,
             showSwitcher:false,
             inline: true,
});
$(".search_one").on("click",function(){
     formData = new FormData();
     formData.append('person_record',$("input[name='search_person_record']").val());
     formData.append('person_name',$("input[name='search_person_name']").val());
     $.ajax({
                url: "{{ url('dashboard/visit/search/all/mokeem') }}",
                type: "POST",
                data: formData,
                async: false,
                //dataType: 'json',
                success: function (response) {

                  console.log($("select[name='moken_select']"));
                  $("select[name='moken_select']").find('option').remove().end().append(response);
                },
              error : function( data )
              {

              },
              cache: false,
              contentType: false,
              processData: false
      });
});
$(".search_two").on("click",function(){
     formData = new FormData();
     formData.append('relative_record',$("input[name='search_relative_record']").val());
     formData.append('relative_name',$("input[name='search_relative_name']").val());
     $.ajax({
                url: "{{ url('dashboard/visit/search/all/relative') }}",
                type: "POST",
                data: formData,
                async: false,
                //dataType: 'json',
                success: function (response) {

                  console.log($("select[name='moken_select']"));
                  $("select[name='relative_select']").find('option').remove().end().append(response);
                },
              error : function( data )
              {

              },
              cache: false,
              contentType: false,
              processData: false
      });
});
$("select[name='visit_type']").on("change",function(){
  var val = $(this).val();
  if(val == "visit_in")
  {
     $("input[name='visite_period']").attr("disabled",true);
  }
  else{
    $("input[name='visite_period']").attr("disabled",false);
  }
})
$("select[name='moken_select']").on("change",function(){
  var val = $(this).val();
  $.ajax({url: "{{ url('dashboard/mokeem/getrelatives') }}"+"/"+val , success: function(result){
      $("select[name='relative_select']").empty();
      $("select[name='relative_select']").append(result);
    }});
});
</script>
@endsection
