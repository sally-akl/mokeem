@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>
    <div class="table-responsive">

        @include("dashboard.utility.error_messages")
      <div class="card-tabs">
                <!-- Cards navigation -->
                <form method="POST" action="{{ url('dashboard/mokeem') }}/{{$mokeem_person->id}}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf


                <ul class="nav nav-tabs">
                  <li class="nav-item"><a href="#tab-top-1" class="nav-link active" data-toggle="tab">المقيم</a></li>
                  <li class="nav-item"><a href="#tab-top-2" class="nav-link" data-toggle="tab">الولى</a></li>
                </ul>
                <div class="tab-content">
                  <!-- Content of card #1 -->
                  <div id="tab-top-1" class="card tab-pane show active">
                    <div class="card-body">

                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.person_num')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="person_num" placeholder="" value="{{$mokeem_person->person_num}}" class="form-control {{ $errors->has('person_num') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class="form-control-label">@lang('site.person_name')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="person_name" placeholder="" value="{{$mokeem_person->person_name}}" class="form-control {{ $errors->has('person_name') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.birth_date')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="birth_date" placeholder="" value="{{ $mokeem_person->birth_year.'-'.$mokeem_person->birth_month.'-'.$mokeem_person->birth_day }}" class="form-control {{ $errors->has('birth_date') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.person_record')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="person_record" placeholder="" value="{{$mokeem_person->person_record}}" class="form-control {{ $errors->has('person_record') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.enter_date')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="enter_date" placeholder="" value="{{ $mokeem_person->enter_date_year.'-'.$mokeem_person->enter_date_month.'-'.$mokeem_person->enter_date_day }}" class="form-control {{ $errors->has('enter_date') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.building')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="building" placeholder="" value="{{ $mokeem_person->building }}" class="form-control {{ $errors->has('building') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.visit_status')</label></div>
                        <div class="col-12 col-md-6"><input type="radio" name="visit_status" value="mokeed" {{ $mokeem_person->visiting_status == "mokeed"?"checked":"" }}  /> <span style="color:red">@lang('site.mokeed')</span> <input type="radio" name="visit_status" value="open" {{ $mokeem_person->visiting_status == "open"?"checked":"" }} /> <span style="color:green">@lang('site.open')</span><input type="radio" name="visit_status" value="not_clear" {{ $mokeem_person->visiting_status == "not_clear"?"checked":"" }} /> <span style="color:#000">@lang('site.not_clear')</span></div>
                      </div>


                    </div>
                  </div>
                  <!-- Content of card #2 -->
                  <div id="tab-top-2" class="card tab-pane">
                    <div class="card-body">
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.person_record')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="parent_record" placeholder="" value="{{ $mokeem_person->parent_record }}" class="form-control {{ $errors->has('parent_record') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.parent_name')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="parent_name" placeholder="" value="{{ $mokeem_person->parent_name }}" class="form-control {{ $errors->has('parent_record') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.relation')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="relation" placeholder="" value="{{ $mokeem_person->parent_relation }}" class="form-control {{ $errors->has('relation') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.address')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="address" placeholder="" value="{{ $mokeem_person->parent_address }}" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.phone_num')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="phone_num" placeholder="" value="{{ $mokeem_person->parent_phone }}" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.work_address')</label></div>
                        <div class="col-12 col-md-6"><input type="text"  name="work_add" placeholder="" value="{{$mokeem_person->parent_work_address  }}" class="form-control {{ $errors->has('work_add') ? ' is-invalid' : '' }}"></div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.pdf1')</label></div>
                        <div class="col-12 col-md-6"><input type="file" class="form-control" name="pdf1"  >
                          @if(!empty($mokeem_person->parent_pdf1))
                          <a href="{{url('/')}}{{$mokeem_person->parent_pdf1 }}">@lang('site.pdf1')</a>
                          @endif
                        </div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.pdf2')</label></div>
                        <div class="col-12 col-md-6"><input type="file" class="form-control" name="pdf2"  >
                          @if(!empty($mokeem_person->parent_pdf2))
                          <a href="{{url('/')}}{{$mokeem_person->parent_pdf2 }}">@lang('site.pdf2')</a>
                          @endif
                        </div>
                      </div>
                      <div class="row form-group row_t">
                        <div class="col col-md-2"><label for="text-input" class=" form-control-label">@lang('site.pdf3')</label></div>
                        <div class="col-12 col-md-6"><input type="file" class="form-control" name="pdf3"  >
                          @if(!empty($mokeem_person->parent_pdf3))
                          <a href="{{url('/')}}{{$mokeem_person->parent_pdf3 }}">@lang('site.pdf3')</a>
                          @endif
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg submit_btn">
                    <i class="fa fa-dot-circle-o"></i> حفظ
                </button>
                </form>
              </div>
    </div>
  </div>

</div>

@endsection
@section('footerjscontent')
<script type="text/javascript">
$("input[name='birth_date']").hijriDatePicker({
             hijri:true,
             showSwitcher:false,
             inline: true,

});
$("input[name='enter_date']").hijriDatePicker({
             hijri:true,
             showSwitcher:false,
             inline: true,
});
</script>
@endsection
