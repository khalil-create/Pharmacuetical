@extends('layouts.index')
@section('title')
    ادارة المناطق
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة المناطق</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">المناطق الفرعية</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  <!-- /.content-header -->
  <div>
    <div class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <span class="card-title" style="float: right"> اضافة مندوبين للمنطقة الفرعية :- 
              <span class="text-bold"> {{$subarea->name_sub_area}}</span>
            </span>
            <div class="card-tools float-right">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <form method="POST" action="/managerSales/storeSubareaReps/{{$subarea->id}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                      <div class="form-group">
                          <label class="col-md-6 control-label">اختر المندوبين <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من مندوب)</span></label>
                          <select name="rep_ids[]" class="form-control custom-select rounded-0" multiple>
                              @foreach ($reps as $row)
                              <option value="{{$row->id}}">{{ $row->user->user_name_third }} {{ $row->user->user_surname }}</option>
                              @endforeach
                          </select>
                          @if ($errors->has('rep_ids'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('rep_ids') }}</strong>
                              </span>
                          @endif
                      </div>
                      <div class="form-group" >
                        <button type="submit" class="btn btn-primary font" style="margin: 10px">
                            حفظ<i class="fas fa-save"></i>
                        </button>
                      </div>
                    </div>
                  </form><!-- /.form -->
                </div><!-- /.form-group -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.card -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
