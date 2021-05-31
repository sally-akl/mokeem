@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">

      <div class="row search_area">
        <div class="col-lg-12">
          <h5>@lang('site.search')</h5>
          <div class="row">
            <div class="col-lg-12">
              <form class="form-inline" method="GET" action="{{ url('dashboard/relative') }}">
                  <div class="form-group mb-2">
                    <label for="staticEmail2" class="my-1 mr-2 search_label">رقم السجل المدنى</label>
                    <input type="text"  name="relative_record" class="form-control my-1 mr-sm-2" id="staticEmail2" value="{{request()->relative_record}}">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="my-1 mr-2 search_label">اسم القريب</label>
                    <input type="text"  name="relative_name" class="form-control" id="staticEmail2" value="{{request()->relative_name}}">
                  </div>
                  <input type="hidden" name="search" value="search" />

                </form>
            </div>
          </div>
        </div>
      </div>




    <div class="table-responsive table-responsive2">
      @include("dashboard.utility.sucess_message")
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th></th>
            <th>
              اسم القريب
            </th>
            <th>
              رقم السجل المدنى
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
          </tr>
        </thead>
        <tbody>
          @foreach ($relivepersons as $key => $relative)
         <tr>
           <td><input type="radio" name="selected_person" value="{{$relative->id}}" /></td>
           <td>{{$relative->relative_name}}</td>
           <td>{{$relative->relative_record}}</td>
           <td>{{$relative->relative_phone}}</td>
           <td>{{$relative->relative_phone2}}</td>
           <td>{{$relative->relative_phone3}}</td>
         </tr>
         @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">

    </div>
  </div>

  <div class="btn-group w-100">
      <input type="hidden" name="person_id" value="" />
      <button type="button" class="btn btn-white active clicked_choose" data-v="add" style="background: #45aaf2 !important;display: flex;flex-direction: column;"> <i class="fas fa-user-plus" style="font-size: x-large;"></i> @lang('site.new_add')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="edit"  style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="far fa-edit" style="font-size: x-large;"></i>@lang('site.edit')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="delete" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-user-times" aria-hidden="true" style="font-size: x-large;"></i>@lang('site.delete')</button>
  </div>
</div>
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')
<script type="text/javascript">

  $(".clicked_choose").on("click",function(){
     var val = $(this).attr("data-v");
     if(val == "add")
     {
       window.location.href = '{{url("/dashboard/relative/create")}}/';
     }

     if(val == "edit")
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب ان تختار بيانات القريب ليتم تعديل بياناته");
       }
       else
       {
         window.location.href = '{{url("/dashboard/relative")}}'+'/'+id+'/edit';
       }

     }
     if(val == "delete")
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب اختيار القريب ليتم حذفه");
       }
       else
       {
         $('#delete_modal').modal('show');
         $("input[name='delete_val']").val(id);

         $(".delete_it_sure").on("click",function(){
            var id = $("input[name='delete_val']").val();
            var url_delete = '{{url("/dashboard/relative/index")}}'+"/"+id;
            $.ajax({url: url_delete , success: function(result){
                    var result = JSON.parse(result);
                    if(result.sucess)
                    {
                      window.location.href = '{{url("/dashboard/relative")}}';
                    }
            }});
          });

       }

     }

  });
  $("input[name='selected_person']").on('change', function() {
    $("input[name='person_id']").val($("input[name='selected_person']:checked").val());
  });

  $("input[name='relative_record']").on("change keyup paste input",function()
  {
     window.location.href = "{{ url('dashboard/relative') }}?relative_record="+$(this).val()+"&relative_name="+$("input[name='relative_name']").val()+"&search=search";
  });

  $("input[name='relative_name']").on("change keyup paste input",function()
  {
     window.location.href = "{{ url('dashboard/relative') }}?relative_record="+$("input[name='relative_record']").val()+"&relative_name="+$(this).val()+"&search=search";
  });
  $(document).ready(function() {
    $('.datatable').DataTable({
        "paging":false,
        "info":false,
        "searching": false
    });
  });
</script>
@endsection
