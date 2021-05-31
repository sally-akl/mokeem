@extends('dashboard.layouts.master')
@section('content')
<div class="row">
   <div class="col-lg-6">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">معلومات المقيم</h3>
       </div>
       <div class="card-body text-center">
         <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <tbody>

                <tr>
                  <th>@lang('site.person_num')</th><td>{{$mokeem_person->person_num}}</td>
                </tr>
                <tr>
                  <th>@lang('site.person_name')</th><td>{{$mokeem_person->person_name}}</td>
                </tr>
                <tr>
                  <th> @lang('site.age')</th><td>  @php $hijri = new \App\Helper\HijriDate();
                         $age =  $hijri->get_year() -  $mokeem_person->birth_year;
                    @endphp
                    {{$age}}
                  </td>
                </tr>
                <tr>
                  <th>@lang('site.birth_date')</th><td>{{ $mokeem_person->birth_year.'-'.$mokeem_person->birth_month.'-'.$mokeem_person->birth_day }}</td>
                </tr>
                <tr>
                  <th> @lang('site.person_record')</th><td>{{$mokeem_person->person_record}}</td>
                </tr>
                <tr>
                  <th>@lang('site.enter_date')</th><td>{{ $mokeem_person->enter_date_year.'-'.$mokeem_person->enter_date_month.'-'.$mokeem_person->enter_date_day }}</td>
                </tr>
                <tr>
                  <th> @lang('site.building')</th><td>{{$mokeem_person->building}}</td>
                </tr>
                <tr>
                  <th> @lang('site.visit_status')</th>
                  <td>
                    @if($mokeem_person->visiting_status == "mokeed")
                      <span>@lang('site.mokeed')</span>
                    @elseif($mokeem_person->visiting_status == "open")
                      <span>@lang('site.open')</span>
                    @else
                      <span>@lang('site.not_clear')</span>
                    @endif
                  </td>
                </tr>


              </tbody>
            </table>
          </div>
       </div>
     </div>
   </div>
   <div class="col-lg-6">
     <div class="card">
       <div class="card-header">
         <h3 class="card-title">الولى</h3>
       </div>
       <div class="card-body text-center">
         <div class="table-responsive">
           <table class="table card-table table-vcenter text-nowrap datatable">
             <tbody>

               <tr>
                 <th>@lang('site.person_record')</th><td>{{$mokeem_person->parent_record}}</td>
               </tr>
               <tr>
                 <th>@lang('site.parent_name')</th><td>{{$mokeem_person->parent_name}}</td>
               </tr>
               <tr>
                 <th>@lang('site.relation')</th><td>{{ $mokeem_person->parent_relation}}</td>
               </tr>
               <tr>
                 <th> @lang('site.address')</th><td>{{$mokeem_person->parent_address}}</td>
               </tr>
               <tr>
                 <th>@lang('site.phone_num')</th><td>{{ $mokeem_person->parent_phone }}</td>
               </tr>
               <tr>
                 <th> @lang('site.work_address')</th><td>{{$mokeem_person->parent_work_address}}</td>
               </tr>
               <tr>
                 <th> @lang('site.pdf1')</th>
                 <td>
                   @if(!empty($mokeem_person->parent_pdf1))
                   <a href="{{url('/')}}{{$mokeem_person->parent_pdf1 }}">@lang('site.pdf1')</a>
                   @endif
                 </td>
               </tr>
               <tr>
                 <th> @lang('site.pdf2')</th>
                 <td>
                   @if(!empty($mokeem_person->parent_pdf2))
                   <a href="{{url('/')}}{{$mokeem_person->parent_pdf2 }}">@lang('site.pdf2')</a>
                   @endif
                 </td>
               </tr>
               <tr>
                 <th> @lang('site.pdf3')</th>
                 <td>
                   @if(!empty($mokeem_person->parent_pdf3))
                   <a href="{{url('/')}}{{$mokeem_person->parent_pdf3 }}">@lang('site.pdf3')</a>
                   @endif
                 </td>
               </tr>


             </tbody>
           </table>
         </div>

       </div>
     </div>
   </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">الاقارب</h3>
  </div>
  <div class="card-body text-center">
    <div class="table-responsive">
      @php  $relatives = \App\MokeemRelative::selectraw("relative_name,relative_record,relative_phone,relative_phone2,relative_phone3,relative_desc")->join("mokeem_person_relative","mokeem_relative.id","relative_id")->where("person_id",$mokeem_person->id)->get();   @endphp
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>

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
            <th>
              صلة القرابة
            </th>


          </tr>
        </thead>
        <tbody>
           @foreach ($relatives as $key => $relative)
          <tr>
            <td>{{$relative->relative_name}}</td>
            <td>{{$relative->relative_record}}</td>
            <td>{{$relative->relative_phone}}</td>
            <td>{{$relative->relative_phone2}}</td>
            <td>{{$relative->relative_phone3}}</td>
            <td>{{$relative->relative_desc}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">الزيارات</h3>
  </div>
  <div class="card-body text-center">
    <div class="table-responsive">
      @php  $visits = \App\PersonVisits::where("person_id",$mokeem_person->id)->get();   @endphp
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
          <tr>

            <th>
              رقم المستفيد
            </th>
            <th>
              اسم المقيم
            </th>
            <th>
             رقم السجل المدنى للقريب
            </th>
            <th>
             اسم القريب
            </th>
            <th>
             نوع الزيارة
            </th>
            <th>التاريخ</th>
            <th>الوقت</th>
            <th>المدة</th>
            <th>عدد الزائرين</th>
            <th>الرقم المرجعى</th>
          </tr>
        </thead>
        <tbody>
           @foreach ($visits as $key => $visit)
          <tr>
            <td>{{$visit->person->person_num}}</td>
            <td>{{$visit->person->person_name}}</td>
            <td>{{$visit->relative->relative_record}}</td>
            <td>{{$visit->relative->relative_name}}</td>
            <td> @if($visit->visit_type == "visit_in")
               <span>داخلية</span>
             @else
               <span>خارجية</span>
             @endif</td>
            <td>{{$visit->visit_date_year."-".$visit->visit_date_month."-".$visit->visit_date_day}}</td>
            <td>{{$visit->visit_time}}</td>
            <td>{{$visit->visit_period}}</td>
            <td>{{$visit->visit_num}}</td>
            <td>{{$visit->visit_rakam}}</td>
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
</script>
@endsection
