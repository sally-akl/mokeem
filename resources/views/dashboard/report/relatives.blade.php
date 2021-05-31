@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">

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
               #
            </th>
            <th>
              اسم القريب
            </th>
            <th>
              رقم الجوال 1
            </th>
            <th>
               رقم الجوال 2
            </th>
            <th>
              رقم الجوال 3
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($relivepersons as $key => $relative)
         <tr>
           <td>{{$key+1}}</td>
           <td>{{$relative->relative_name}}</td>
           <td>{{$relative->relative_phone}}</td>
           <td>{{$relative->relative_phone2}}</td>
           <td>{{$relative->relative_phone3}}</td>
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
