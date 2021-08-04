@extends('layouts.index')
@section('title')
    ادارة المناطق
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المناطق الرئيسية</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">المناطق الرئيسية</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">إضافة منطقة رئيسية</h3>
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
                            <form method="POST" action="{{ url('managerSales/storeMainArea') }}"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_main_area">اسم المنطقة الرئيسية</label>
                                        <input type="text" name="name_main_area" class="form-control" id="name_main_area">
                                        @if ($errors->has('name_main_area'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('name_main_area') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('supervisor_id') ? ' has-error' : '' }}">
                                        <label for="supervisor_id" class="col-md-2 control-label">المشرف عليها</label>
                                            <select name="supervisor_id" class="form-control custom-select rounded-0">
                                                @foreach ($supervisors as $sup)
                                                <option value="{{$sup->supervisor->id}}">{{ $sup->user_name_third }} {{$sup->user_surname}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('supervisor_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('supervisor_id') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                    <div class="form-group" >
                                        <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                            حفظ<i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                </div>
                                </div>
                                <!-- /.col -->
                                
                                <!-- /.form-group -->
                            </form>
                        <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection