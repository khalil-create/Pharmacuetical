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
            <li class="breadcrumb-item active">المناطق الرئيسية</li>
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
            <span class="card-title" style="float: right"> اضافة منطقة رئيسية للمندوب :- <h5>
              @if (isset($rep))
                  {{$rep->user->user_name_third}} {{$rep->user->user_surname}}
              @endif
            </h5>
              التابعه للمشرف :- 
              <h5>{{$rep->supervisor->user->user_name_third}} {{$rep->supervisor->user->user_surname}}</h5> 
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
            @if (session('status'))
                <div class="alert alert-success notify-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger notify-error">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                  @if($mainareas->count() > 0)
                    <form method="POST" action="/admin/storeRepMainArea/{{$rep->id}}"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="main_area_id" class="col-md-4 control-label">اختر المنطقة الرئيسية</label>
                                    <select name="main_area_id" class="form-control custom-select rounded-0">
                                        @foreach ($mainareas as $row)
                                        <option value="{{$row->id}}">{{ $row->name_main_area }}</option>
                                        @endforeach
                                    </select>
                                @if ($errors->has('main_area_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_area_id') }}</strong>
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
                        {{ 'لم يتم اضافة اي منطقة رئيسية لهذا المشرف الرجاء اضافة المنطقة الرئيسية من ادارة المناطق' }}               
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
