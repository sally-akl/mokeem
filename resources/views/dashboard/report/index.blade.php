@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">
     <div class="row">
       <div class="col-lg-4">
          <a href="{{ url('dashboard/report/visitcount') }}/{{$type}}">تقرير زيارات سجل القسم العام</a>
       </div>
       <div class="col-lg-4">
         <a href="{{ url('dashboard/report/visitmokeem') }}/{{$type}}">تقرير زيارات لمقيم معين</a>
       </div>
       <div class="col-lg-4">
         <a href="{{ url('dashboard/report/relatives') }}/{{$type}}">تقرير باسماء اقارب المقيمين والمقيمات</a>
       </div>
     </div>
  </div>
</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
