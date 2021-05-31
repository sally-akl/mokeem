@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">

      <div class="row search_area">
        <div class="col-lg-12">
          <h5>@lang('site.search')</h5>
          <div class="row">
            <div class="col-lg-12">
              <form class="form-inline" method="GET" action="{{ url('dashboard/report/visitcount') }}/{{$type}}">
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
    <div id="datatable">
    <div class="table-responsive">
      @include("dashboard.utility.sucess_message")

      <form class="form-inline dtae_all" >
          <div class="form-group mb-2">
            <label for="staticEmail2" class="my-1 mr-2 search_label">من تاريخ</label>
            <input type="text"  name="from_date" class="form-control my-1 mr-sm-2" id="staticEmail2" value="{{request()->from_date}}" disabled>
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2" class="my-1 mr-2 search_label">الى تاريخ</label>
            <input type="text"  name="to_date" class="form-control" id="staticEmail2" value=" {{request()->to_date}}" disabled>
          </div>

        </form>

      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>
            <th>
               #
            </th>
            <th>
               @lang('site.person_name')
            </th>
            <th>
               @lang('site.visite_num_in')
            </th>
            <th>
               @lang('site.visite_num_out')
            </th>
          </tr>
        </thead>
        <tbody>
            @php
              $total_in = 0;
              $total_out = 0;
            @endphp
          	@foreach ($mokeem_persons as $key => $person)
              @if($person->parent_type == $type)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$person->person_name}}</td>
            <td>{{$person->vn}}</td>
            <td>{{$person->vout}}</td>
            @php
              $total_in += $person->vn;
              $total_out +=$person->vout;
            @endphp
          </tr>
             @endif
          @endforeach
        </tbody>
      </table>


      <table class="table card-table table-vcenter text-nowrap st_tb">
         <tr>
            <td>عدد الزيارات الداخلية</td>
            <td>{{$total_in}}</td>
         </tr>
         <tr>
            <td>عدد الزيارات الخارجية</td>
            <td>{{$total_out}}</td>
         </tr>
         <tr>
            <td>المجموع الكلى</td>
            <td>{{$total_in + $total_out}}</td>
         </tr>
      </table>


    </div>



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
