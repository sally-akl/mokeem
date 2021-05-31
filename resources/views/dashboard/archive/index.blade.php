@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">



    <div class="table-responsive">
      @include("dashboard.utility.sucess_message")
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th></th>

            <th>
               @lang('site.person_name')
            </th>
            <th>
              سبب الارشفة
            </th>
            <th>
               تاريخ الارشفة
            </th>

          </tr>
        </thead>
        <tbody>
          	@foreach ($mokeem_persons as $key => $person)
          <tr>
            <td><input type="radio" name="selected_person" value="{{$person->id}}" /></td>

            <td>{{$person->person_name}}</td>
            <td>{{$person->archive_reason}}</td>
            <td>{{$person->archive_date_year."-".$person->archive_date_month."-".$person->archive_date_day}}</td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      {{$mokeem_persons->links('dashboard.vendor.pagination.default')}}
    </div>
  </div>

  <div class="btn-group w-100">
      <input type="hidden" name="person_id" value="" />
      <button type="button" class="btn btn-white active clicked_choose" data-v="view" style="background: #45aaf2 !important;display: flex;flex-direction: column;"><i class="fa fa-eye" aria-hidden="true" style="font-size: x-large;"></i>@lang('site.view')</button>

  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">

  $(".clicked_choose").on("click",function(){
     var val = $(this).attr("data-v");
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
  });
  $("input[name='selected_person']").on('change', function() {
    $("input[name='person_id']").val($("input[name='selected_person']:checked").val());
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
