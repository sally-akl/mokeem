@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">

      <div class="row">
        <div class="col-lg-12">
          <table class="table card-table table-vcenter text-nowrap datatable">
            <tbody>

              <tr>
                <th>@lang('site.person_num')</th><td>{{$mokeem_person->person_num}}</td>
              </tr>
              <tr>
                <th>@lang('site.person_name')</th><td>{{$mokeem_person->person_name}}</td>
              </tr>

            </tbody>
          </table>

        </div>
      </div>
      <div class="row search_area">
        <div class="col-lg-6">

          <form class="form-inline">
            <div class="form-group mb-2">
              <label for="staticEmail2" class="my-1 mr-2 search_label">اسم القريب</label>
              <input type="text"  name="relative_name" class="form-control my-1 mr-sm-2" id="staticEmail2" value="">
            </div>
            <div class="form-group mb-2">
              <label for="staticEmail2" class="my-1 mr-2 search_label">الرقم المدنى</label>
              <input type="text"  name="record_relatve_num" class="form-control my-1 mr-sm-2" id="staticEmail2" value="">
            </div>
          </form>

        </div>
      </div>




    <div class="table-responsive">
      <form class="form-inline" method="POST" action="{{ url('dashboard/mokeem') }}/save/relation">
        @csrf
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
              رقم السجل المدنى
            </th>
            <th>
              اسم القريب
            </th>
            <th>
              رقم الهاتف
            </th>
            <th>
              رقم الهاتف التانى
            </th>
            <th>
              رقم الهاتف الثالث
            </th>
            <th>صلة القرابة</th>
          </tr>
        </thead>
        <tbody class="tbody_relation">

        </tbody>
      </table>
      <input type="hidden" name="person_data_id" value="{{$id}}" />
      <button type="submit" class="btn btn-primary btn-lg submit_btn">
          اضافة
      </button>
    </form>
    </div>
  </div>
</div>

@endsection
@section('footerjscontent')
<script type="text/javascript">
$("input[name='relative_name']").on("change keyup paste input",function()
{
   var val = $(this).val();
   var rec = $("input[name='record_relatve_num']").val();
   $.ajax({url: "{{ url('dashboard/mokeem') }}/relation/?val="+val+"&rec="+rec , success: function(result){
        $(".tbody_relation").html(result);
  }});
});
$("input[name='record_relatve_num']").on("change keyup paste input",function()
{
   var val = $(this).val();
   var rec = $("input[name='relative_name']").val();
   $.ajax({url: "{{ url('dashboard/mokeem') }}/relation?val="+rec+"&rec="+val , success: function(result){
        $(".tbody_relation").html(result);
  }});
});
</script>
@endsection
