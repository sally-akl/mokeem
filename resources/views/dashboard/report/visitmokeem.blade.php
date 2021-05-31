@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">

      <div class="row search_area">
        <div class="col-lg-12">
          <h5>@lang('site.search')</h5>
          <div class="row">
            <div class="col-lg-12">
              <form class="form-inline" method="GET" action="{{ url('dashboard/report/visitmokeem') }}/{{$type}}">
                  <div class="form-group mb-2">
                    <label for="staticEmail2" class="my-1 mr-2 search_label">اسم المقيم</label>
                    <select name="mokeem_name" class="form-control">
                      @foreach(\App\MokeemPerson::where("parent_type",$type)->where("is_archive",0)->get() as $person)
                        <option value="{{$person->id}}">{{$person->person_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group mb-2">
                    <label for="staticEmail2" class="my-1 mr-2 search_label">من تاريخ</label>
                    <input type="text"  name="from_date" class="form-control my-1 mr-sm-2" id="staticEmail2" value="">
                  </div>
                  <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="my-1 mr-2 search_label">الى تاريخ</label>
                    <input type="text"  name="to_date" class="form-control" id="staticEmail2" value="">
                  </div>

                  <input type="hidden" name="search" value="search" />
                  <button type="submit" class="btn btn-primary mb-2">@lang('site.search')</button>
                </form>
            </div>
          </div>
        </div>
      </div>


      <div class="row" style="margin-top:10px;margin-bottom:10px;">
        <div class="col-lg-12" style="text-align:left">
          <input type="button" value="Print" class="prnt_btn" />
        </div>
      </div>

    <div class="table-responsive">

      <table class="table card-table table-vcenter text-nowrap datatable" id="datatable">
        <thead>
          <tr>

            <th>
              اسم المقيم
            </th>
            <th>
             نوع الزيارة
            </th>

            <th>
             اسم الزائر
            </th>

            <th>تاريخ الزيارة</th>
            <th>مدة الزيارة</th>
            <th>وقت الزيارة</th>


          </tr>
        </thead>
        <tbody>
          @foreach ($visits as $key => $visit)
         <tr>
           <td>{{$visit->person->person_name}}</td>
           <td>
             @if($visit->visit_type == "visit_in")
               <span>داخلية</span>
             @else
               <span>خارجية</span>
             @endif
           </td>
           <td>{{$visit->relative->relative_name}}</td>
           <td>{{$visit->visit_date_year."-".$visit->visit_date_month."-".$visit->visit_date_day}}</td>
            <td>{{$visit->visit_period}}</td>
           <td>{{$visit->visit_time}}</td>


         </tr>
         @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
  $("input[name='from_date']").hijriDatePicker({
               hijri:true,
               showSwitcher:false,
               inline: true,
  });
  $("input[name='to_date']").hijriDatePicker({
               hijri:true,
               showSwitcher:false,
               inline: true,
  });
  $(".prnt_btn").on("click",function(){
     printJS({ printable: 'datatable', type: 'html', css: ["{{ asset('css/tabler.min.css') }}","{{ asset('css/custom.css') }}"]})
  });
</script>
@endsection
