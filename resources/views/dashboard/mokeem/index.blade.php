@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">

      <div class="row search_area">
        <div class="col-lg-12">
          <h5>@lang('site.search')</h5>
          <div class="row">
            <div class="col-lg-12">
              <form class="form-inline" method="GET" action="{{ url('dashboard/mokeem') }}/{{$type_link}}">
                  <div class="form-group mb-2">
                    <label for="staticEmail2" class="my-1 mr-2 search_label">@lang('site.person_num')</label>
                    <input type="text"  name="person_number" class="form-control my-1 mr-sm-2" id="staticEmail2" value="{{request()->person_number}}">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="my-1 mr-2 search_label">@lang('site.person_name')</label>
                    <input type="text"  name="person_name" class="form-control" id="staticEmail2" value="{{request()->person_name}}">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="my-1 mr-2 search_label">@lang('site.parent_name')</label>
                    <input type="text"  name="parent_name" class="form-control" id="staticEmail2" value="{{request()->parent_name}}">
                  </div>
                  <input type="hidden" name="search" value="search" />
                <!--  <button type="submit" class="btn btn-primary mb-2">@lang('site.search')</button>  -->
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
               @lang('site.person_num')
            </th>
            <th>
               @lang('site.person_name')
            </th>
            <th>
               @lang('site.age')
            </th>
            <th>
               @lang('site.building')
            </th>
            <th>
               @lang('site.visite_num_in')
            </th>
            <th>
               @lang('site.visite_num_out')
            </th>
            <th>
               @lang('site.date_last_visit')
            </th>
            <th>
               @lang('site.visit_status')
            </th>

          </tr>
        </thead>
        <tbody>
          	@foreach ($mokeem_persons as $key => $person)
          <tr>
            <td><input type="radio" name="selected_person" value="{{$person->id}}" /></td>
            <td>{{$person->person_num}}</td>
            <td> <a href ='{{url("/dashboard/mokeem")}}/{{$person->id}}/show'> {{$person->person_name}}</a></td>
            @php $hijri = new \App\Helper\HijriDate();
                 $age =  $hijri->get_year() -  $person->birth_year;
            @endphp
            <td>{{$age}}</td>
            <td>{{$person->building}}</td>
            <td>{{$person->visites()->where("visit_type","visit_in")->count()}}</td>
            <td>{{$person->visites()->where("visit_type","visit_out")->count()}}</td>
            @php  $last_visit = $person->visites()->orderBy("visit_date_day","desc")->orderBy("visit_date_month","desc")->orderBy("visit_date_year","desc")->first();   @endphp
            <td>{{ isset($last_visit) ? $last_visit->visit_date_year."-".$last_visit->visit_date_month."-".$last_visit->visit_date_day:""}}</td>
            <td>
              @if($person->visiting_status == "mokeed")
                <span>@lang('site.mokeed')</span>
              @elseif($person->visiting_status == "open")
                <span>@lang('site.open')</span>
              @else
                <span>@lang('site.not_clear')</span>
              @endif


            </td>
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
      <input type="hidden" name="person_type" value="{{$type}}" />
      <button type="button" class="btn btn-white active clicked_choose" data-v="add" style="background: #45aaf2 !important;display: flex;flex-direction: column;"> <i class="fas fa-user-plus" style="font-size: x-large;"></i> @lang('site.new_add')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="edit"  style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="far fa-edit" style="font-size: x-large;"></i>@lang('site.edit')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="delete" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-user-times" aria-hidden="true" style="font-size: x-large;"></i>@lang('site.delete')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="view" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-eye" aria-hidden="true" style="font-size: x-large;"></i>@lang('site.view')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="family" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-users" aria-hidden="true" style="font-size: x-large;"></i>@lang('site.family')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="report" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-file" aria-hidden="true" style="font-size: x-large;"></i>@lang('site.reports')</button>
      <button type="button" class="btn btn-white active clicked_choose" data-v="move" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-square" aria-hidden="true"  style="font-size: x-large;"></i>نقل المقيم</button>
  </div>
</div>
<div class="modal modal-blur fade" id="archive_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">@lang('site.new_add')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="18" y1="6" x2="6" y2="18" /><line x1="6" y1="6" x2="18" y2="18" /></svg>
        </button>
      </div>
      <div class="alert alert-danger alert-danger-modal" style="display:none">
      </div>
      <div class="alert alert-success alert-success-modal" style="display:none">
      </div>
      <form method="POST" action="{{ url('dashboard/mokeem/archive') }}" class="form_submit_model">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">سبب الارشفة</label>
              <textarea class="form-control desc" rows="3" name="archive_reason"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">تاريخ الارشفة</label>
              <input type="text" class="form-control" name="archive_date">
          </div>
          <input type="hidden" name="person_archive_id" value="" />

        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-link link-secondary" data-dismiss="modal">
            @lang('site.cancel')
          </a>
          <button type="submit" class="btn btn-primary">+ {{ __('site.save') }} </button>
        </div>
      </form>
    </div>
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
       var person_type = $("input[name='person_type']").val();
       window.location.href = '{{url("/dashboard/mokeem/create")}}/'+person_type;
     }

     if(val == "edit")
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب ان تختار مقيم ليتم تعديل بياناته");
       }
       else
       {
         window.location.href = '{{url("/dashboard/mokeem")}}'+'/'+id+'/edit';
       }

     }
     if(val == "delete")
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب اختيار المقيم ليتم ارشفته");
       }
       else
       {
         $("input[name='person_archive_id']").val(id);
         $('#archive_modal').modal('show');
         $(".form_submit_model").submit(function(e){

            e.preventDefault();
            var submit_form_url = $(this).attr('action');
            var $method_is = "POST";
            var formData = new FormData($(this)[0]);
            $(".alert-success-modal").css("display","none");
            $(".alert-danger-modal").css("display","none");
            $.ajax({
                  url: submit_form_url,
                  type: $method_is,
                  data: formData,
                  async: false,
                  dataType: 'json',
                  success: function (response) {
                    if(response.sucess)
                    {
                      $(".alert-success-modal").html(response.sucess_text);
                      $(".alert-success-modal").css("display","block");
                      $('#add_edit_modal').modal('hide');
                      $("input[name='method_type']").val("add");
                      window.location.href = "{{ url('dashboard/mokeem') }}/{{$type_link}}";
                    }
                    else
                    {
                      var $error_text = "";
                      var errors = response.errors;

                      $.each(errors, function (key, value) {
                        $error_text +=value+"<br>";
                      });

                      $(".alert-danger-modal").html($error_text);
                      $(".alert-danger-modal").css("display","block");

                    }
                  },
                  error : function( data )
                  {

                  },
                  cache: false,
                  contentType: false,
                  processData: false
              });
              return false;
            });
          }

     }
     if( val== 'view')
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب اختيار المقيم لاظهار بياناته");
       }
       else
       {
          window.location.href = '{{url("/dashboard/mokeem")}}'+'/'+id+'/show';
       }

     }
     if(val == 'family')
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب اختيار المقيم اولا");
       }
       else
       {
          window.location.href = '{{url("/dashboard/mokeem")}}'+'/'+id+'/family';
       }

     }
     if(val == 'move')
     {
       var id = $("input[name='person_id']").val();
       if(id == "")
       {
         alert("يجب اختيار المقيم لاظهار بياناته");
       }
       else
       {
          window.location.href = '{{url("/dashboard/mokeem")}}'+'/'+id+'/'+'{{$type}}'+'/move';
       }

     }
     if(val == "report")
     {
       window.location.href = '{{url("/dashboard/report")}}/{{$type}}';
     }

  });
  $("input[name='selected_person']").on('change', function() {
    $("input[name='person_id']").val($("input[name='selected_person']:checked").val());
  });
  $("input[name='archive_date']").hijriDatePicker({
               hijri:true,
               showSwitcher:false,
               inline: true,
  });

  $("input[name='person_number']").on("change keyup paste input",function()
  {
     window.location.href = "{{ url('dashboard/mokeem') }}/{{$type_link}}?person_number="+$(this).val()+"&person_name="+$("input[name='person_name']").val()+"&parent_name="+$("input[name='parent_name']").val()+"&search=search";
  });

  $("input[name='person_name']").on("change keyup paste input",function()
  {
      window.location.href = "{{ url('dashboard/mokeem') }}/{{$type_link}}?person_number="+$("input[name='person_number']").val()+"&person_name="+$(this).val()+"&parent_name="+$("input[name='parent_name']").val()+"&search=search";
  });

  $("input[name='parent_name']").on("change keyup paste input",function()
  {
     window.location.href = "{{ url('dashboard/mokeem') }}/{{$type_link}}?person_number="+$("input[name='person_number']").val()+"&person_name="+$("input[name='person_name']").val()+"&parent_name="+$(this).val()+"&search=search";
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
