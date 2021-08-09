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
    </div>
    <!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">إضافة منطقة فرعية</h3>
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
                            @if(isset($mainarea))
                                <form method="POST" action="/supervisor/storeSubArea/{{$mainarea->id}}"  enctype="multipart/form-data">
                            @else
                                <form method="POST" action="{{ url('supervisor/storeSubArea/0') }}"  enctype="multipart/form-data">
                            @endif
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name_sub_area">اسم المنطقة الفرعية</label>
                                    <input type="text" name="name_sub_area" class="form-control" id="name_sub_area">
                                    @if ($errors->has('name_sub_area'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('name_sub_area') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name_main_area" class="col-md-6 control-label">المنطقة الرئيسية التابعة لها</label>
                                            <select name="name_main_area" id="name_main_area" class="form-control custom-select rounded-0">
                                                @if(isset($mainarea))
                                                    <option>{{ $mainarea->name_main_area }}</option>
                                                @else
                                                    @foreach ($mainareas as $area)
                                                        <option value="{{$area->name_main_area}}">{{ $area->name_main_area }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        @if ($errors->has('name_main_area'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name_main_area') }}</strong>
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
                        </div>
                        <!-- /.col -->
                    </div>
                <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                the plugin.
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection