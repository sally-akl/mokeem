@extends('dashboard.layouts.master')
@section('content')

<div class="card">

  <div class="card-body border-bottom py-3">
    <div class="d-flex">

    </div>

        @include("dashboard.utility.error_messages")
      <div class="card-tabs">
                <!-- Cards navigation -->
                <form method="POST" action="{{ url('dashboard/relative') }}/{{$relative->id}}" class="form-horizontal" enctype="multipart/form-data">
                  @csrf

                  <div class="row form-group row_t">
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">رقم السجل المدنى</label></div>
                    <div class="col-12 col-md-6"><input type="text"  name="relative_record" placeholder="" value="{{ $relative->relative_record }}" class="form-control {{ $errors->has('relative_record') ? ' is-invalid' : '' }}"></div>
                  </div>
                  <div class="row form-group row_t">
                    <div class="col col-md-2"><label for="text-input" class="form-control-label">الاسم</label></div>
                    <div class="col-12 col-md-6"><input type="text"  name="relative_name" placeholder="" value="{{ $relative->relative_name }}" class="form-control {{ $errors->has('relative_name') ? ' is-invalid' : '' }}"></div>
                  </div>
                  <div class="row form-group row_t">
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">رقم الهاتف</label></div>
                    <div class="col-12 col-md-6"><input type="text"  name="relative_phone" placeholder="" value="{{ $relative->relative_phone }}" class="form-control {{ $errors->has('relative_phone') ? ' is-invalid' : '' }}"></div>
                  </div>
                  <div class="row form-group row_t">
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">رقم الهاتف التانى</label></div>
                    <div class="col-12 col-md-6"><input type="text"  name="relative_phone2" placeholder="" value="{{ $relative->relative_phone2 }}" class="form-control {{ $errors->has('relative_phone2') ? ' is-invalid' : '' }}"></div>
                  </div>
                  <div class="row form-group row_t">
                    <div class="col col-md-2"><label for="text-input" class=" form-control-label">رقم الهاتف الثالث</label></div>
                    <div class="col-12 col-md-6"><input type="text"  name="relative_phone3" placeholder="" value="{{$relative->relative_phone3 }}" class="form-control {{ $errors->has('relative_phone3') ? ' is-invalid' : '' }}"></div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-lg submit_btn">
                      <i class="fa fa-dot-circle-o"></i> حفظ
                  </button>
                </form>
              </div>
  </div>

</div>

@endsection
@section('footerjscontent')
<script type="text/javascript">
</script>
@endsection
