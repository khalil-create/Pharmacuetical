@extends('layouts.index')
@section('title')
    ادارة المنوبين العلميين
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة المنوبين العلميين</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">المندوبيين العلميين</li>
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
            <span class="card-title" style="float: right"> اضافة مناطق فرعية للمندوب :- 
              <h5> {{$rep->user->user_name_third}} {{$rep->user->user_surname}} </h5>
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
                  @if($subareas->count() > 0)
                    <form method="POST" action="/supervisor/storeRepSubareas/{{$rep->id}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="sub_area_ids" class="col-md-6 control-label"> اختر المناطق الفرعية   <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من منطقة)</span></label>
                                    <select name="sub_area_ids[]" class="form-control custom-select rounded-0" multiple>
                                        @foreach ($subareas as $row)
                                        <option value="{{$row->id}}">{{ $row->name_sub_area }}</option>
                                        @endforeach
                                    </select>
                                @if ($errors->has('sub_area_ids'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sub_area_ids') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group" >
                            <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                حفظ<i class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                    </div>
                    </div>
                    <!-- /.col -->
                    
                    <!-- /.form-group -->
                </form>
                <!-- /.form-group -->
                @else
                    <div class="alert alert-danger notify-danger">
                        {{ 'لم يتم اضافة اي منطقة فرعية لهذا المشرف الرجاء اضافة منطقة فرعية من ادارة المناطق' }}               
                    </div>
                    {{-- <a href="/addUse/{{$id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة استخدام</a> --}}
                @endif
                </div>
                <!-- /.col -->
            </div>
        <!-- /.row -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>
@endsection
