@extends('dashboard.layouts.master')
@section('content')
<div class="row">
   <div class="col-lg-12">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">الاحصائيات</h3>
         <select name="year_select">
           @php $hijri = new \App\Helper\HijriDate();
                $year =  $hijri->get_year();
                $years =[];
                for($h=10;$h>=1;$h--)
                {
                  $years[] =$year+$h;
                }
                $years[] =$year;
                for($h=1;$h<=10;$h++)
                {
                  $years[] =$year-$h;
                }

           @endphp
           <option value="0">اختر</option>
           @foreach($years as $y)
            <option value="{{$y}}" {{request()->year == $y?"selected":"" }}>{{$y}} </option>
           @endforeach
         </select>
       </div>
       <div class="card-body text-center">
         <div class="row">
            <div class="col-lg-6">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <tbody>

                  <tr>
                    @php



                        if(isset(request()->year))
                        {
                          $male_in_count =  \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",1)
                                                          ->where("is_archive",0)
                                                          ->where("mokeem_person_visits.visit_type","visit_in")
                                                          ->where("mokeem_person_visits.visit_date_year",request()->year)
                                                          ->count();
                          $male_out_count = \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",1)
                                                          ->where("is_archive",0)
                                                          ->where("mokeem_person_visits.visit_date_year",request()->year)
                                                          ->where("mokeem_person_visits.visit_type","visit_out")->count();

                          $femail_in_count = \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",2)
                                                          ->where("is_archive",0)
                                                          ->where("mokeem_person_visits.visit_date_year",request()->year)
                                                          ->where("mokeem_person_visits.visit_type","visit_in")->count();
                          $femail_out_count = \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",2)
                                                          ->where("is_archive",0)
                                                          ->where("mokeem_person_visits.visit_date_year",request()->year)
                                                          ->where("mokeem_person_visits.visit_type","visit_out")->count();


                        }
                        else{

                          $male_in_count =  \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",1)
                                                          ->where("is_archive",0)->where("mokeem_person_visits.visit_type","visit_in")->count();
                          $male_out_count = \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",1)
                                                          ->where("is_archive",0)->where("mokeem_person_visits.visit_type","visit_out")->count();

                          $femail_in_count = \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",2)
                                                          ->where("is_archive",0)->where("mokeem_person_visits.visit_type","visit_in")->count();
                          $femail_out_count = \App\MokeemPerson::leftjoin("mokeem_person_visits","mokeem_person_visits.person_id","mokeem_person.id")
                                                          ->orderBy("mokeem_person.id","desc")
                                                          ->where("parent_type",2)
                                                          ->where("is_archive",0)->where("mokeem_person_visits.visit_type","visit_out")->count();


                        }


                    @endphp
                    <th>عدد الزيارات الداخلية ذكور</th><td>{{$male_in_count}}</td>
                  </tr>
                  <tr>
                    <th>عدد الزيارات الخارجية ذكور</th><td>{{$male_out_count}}</td>
                  </tr>
                  <tr>
                    <th>عدد الزيارات الداخلية اناث</th><td>{{$femail_in_count}}</td>
                  </tr>
                  <tr>
                    <th>عدد الزيارات الخارجية اناث</th><td>{{$femail_out_count}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6">
                <div id="chart-total-sales"></div>
            </div>
         </div>

       </div>
     </div>
   </div>
</div>

<div class="row">
   <div class="col-lg-12">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">احصائيات المقيمين والمقيمات</h3>
       </div>
       <div class="card-body text-center">
         <div class="row">
            <div class="col-lg-6">
              <table class="table card-table table-vcenter text-nowrap datatable">
                <tbody>

                  <tr>
                    @php


                    $male_how_count =  \App\MokeemPerson::where("parent_type",1)
                                                    ->where("is_archive",0)
                                                    ->count();

                    $female_how_count = \App\MokeemPerson::where("parent_type",2)
                                                    ->where("is_archive",0)->count();



                    @endphp
                    <th>عدد المقيمين</th><td>{{$male_how_count}}</td>
                  </tr>
                  <tr>
                    <th>عدد المقيمات</th><td>{{$female_how_count}}</td>
                  </tr>

                </tbody>
              </table>
            </div>
            <div class="col-lg-6">
                <div id="chart-total-people"></div>
            </div>
         </div>

       </div>
     </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">اخر زيارة</h3>
       </div>
       <div class="card-body text-center">
         <div class="row">
           <div class="col-lg-6">
             <table class="table card-table table-vcenter text-nowrap datatable">
               <tbody>

                 <tr>
                   @php  $visit = \App\PersonVisits::selectraw("CAST(CONCAT(visit_date_year,'-',visit_date_month,'-',visit_date_day) as DATE) as date_concat , mokeem_person_visits.*")->orderBy("date_concat","desc")->orderBy("id","desc")->first();

                   @endphp
                   <th>  رقم المستفيد</th><td>{{isset($visit) && $visit!==null?$visit->person->person_num:"--"}}</td>
                 </tr>
                 <tr>
                   <th>  اسم المقيم</th><td>{{isset($visit)&& $visit!==null?$visit->person->person_name:"--"}}</td>
                 </tr>
                 <tr>
                   <th> رقم السجل المدنى للقريب</th><td>{{isset($visit)&& $visit!==null?$visit->relative->relative_record:"--"}}</td>
                 </tr>
                 <tr>
                   <th> اسم القريب</th><td>{{isset($visit)&& $visit!==null?$visit->relative->relative_name:"--"}}</td>
                 </tr>
                 <tr>
                   <th> نوع الزيارة</th><td>
                    @if(isset($visit)&& $visit!==null)
                       @if($visit->visit_type == "visit_in")
                        <span>داخلية</span>
                       @else
                        <span>خارجية</span>
                       @endif
                    @endif
                  </td>
                 </tr>
               </tbody>
             </table>
           </div>
           <div class="col-lg-6">
             <table class="table card-table table-vcenter text-nowrap datatable">
               <tbody>

                 <tr>

                   <th>التاريخ</th><td>{{isset($visit)&& $visit!==null?$visit->visit_date_year."-".$visit->visit_date_month."-".$visit->visit_date_day:"--"}}</td>
                 </tr>
                 <tr>
                   <th>التوقيت</th><td>{{isset($visit)&& $visit!==null?$visit->visit_time:"--"}}</td>
                 </tr>
                 <tr>
                   <th>المدة</th><td>{{isset($visit)&& $visit!==null?$visit->visit_period:"--"}}</td>
                 </tr>
                 <tr>
                   <th>عدد الزائرين</th><td>{{isset($visit)&& $visit!==null?$visit->visit_num:"--"}}</td>
                 </tr>
               </tbody>
             </table>
           </div>
         </div>
       </div>
     </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">النسخ الاحتياطى</h3>
         <form action="{{ url('dashboard') }}" method="get">
           <input type="hidden" name="backup" value="backup" />
           <input type="submit" value="نسخة احتياطية جديدة" />
         </form>
       </div>
       <div class="card-body text-center">
         <div class="row">
           <div class="col-lg-12">
             @php
              $manuals = array();
              if(\File::exists(storage_path() . "/backups"))
              {
                $filesInFolder = \File::files(storage_path() . "/backups");

                foreach($filesInFolder as $path)
                {
                     $manuals[] = pathinfo($path);
                }

              }



             @endphp
             <div class="table-responsive table-responsive2">
             <table class="table card-table table-vcenter text-nowrap datatable">
               <thead>
                 <tr>
                   <th>اسم الملف</th>
                   <th></th>
                 </tr>
               </thead>
               <tbody>

                 	@foreach ($manuals as $key => $file)
                 <tr>
                   <td>{{$file["filename"]}}</td>
                   <td><a class='btn btn-info btn-xs' href="{{ url('dashboard/download') }}/{{$file['basename']}}/{{$file['filename']}}">
    						      تنزيل
    				      	</a></td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
             </div>

           </div>
         </div>
       </div>
     </div>
   </div>
</div>
@endsection
@section('footerjscontent')
<script>
document.addEventListener("DOMContentLoaded", function () {
  window.ApexCharts && (new ApexCharts(document.getElementById('chart-total-sales'), {
    chart: {
      type: "donut",
      fontFamily: 'inherit',
      height: 240,
      sparkline: {
        enabled: true
      },
      animations: {
        enabled: false
      },
    },
    fill: {
      opacity: 1,
    },
    series: [{{$male_in_count}}, {{$male_out_count}}, {{$femail_in_count}}, {{$femail_out_count}}],
    labels: ["عدد الزيارات الداخلية ذكور", "عدد الزيارات الخارجية ذكور", "عدد الزيارات الداخلية اناث", "عدد الزيارات الخارجية اناث"],
    grid: {
      strokeDashArray: 4,
    },
    colors: ["#206bc4", "#79a6dc", "#bfe399", "#e9ecf1"],
    legend: {
      show: false,
    },
    tooltip: {
      fillSeriesColor: false
    },
  })).render();

  window.ApexCharts && (new ApexCharts(document.getElementById('chart-total-people'), {
    chart: {
      type: "donut",
      fontFamily: 'inherit',
      height: 240,
      sparkline: {
        enabled: true
      },
      animations: {
        enabled: false
      },
    },
    fill: {
      opacity: 1,
    },
    series: [{{$male_how_count}}, {{$female_how_count}}],
    labels: ["عدد المقيمين","عدد المقيمات"],
    grid: {
      strokeDashArray: 4,
    },
    colors: ["#206bc4", "#79a6dc"],
    legend: {
      show: false,
    },
    tooltip: {
      fillSeriesColor: false
    },
  })).render();
});

$("select[name='year_select']").on("change",function(){
    var val = $(this).val();
    window.location.href = "{{ url('dashboard') }}?year="+val;
});
</script>
@endsection
