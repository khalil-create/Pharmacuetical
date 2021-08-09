@extends('layouts.index')
@section('title')
    ادارة المواد التدريبية
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المواد التدريبية</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">المواد التدريبية</li>
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
                    <h3 class="card-title" style="float: right">تعديل البرنامج التدريبي</h3>
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
                    @if (session('error'))
                        <div class="alert alert-danger notify-error">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                            <form method="POST" action="/supervisor/updateCourse/{{$course->id}}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">الصنف</label>
                                        <select name="item_id" class="form-control custom-select rounded-0">
                                            @foreach ($items as $i)
                                                <option value="{{$i->id}}"
                                                    @if ($course->item_id == $i->id)
                                                        {{'selected'}}
                                                    @endif
                                                    >{{$i->commercial_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('item_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('item_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label>عنوان البرنامج التدريبي</label>
                                    <input value="{{$course->title}}" type="text" name="title" class="form-control">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="khalil col-md-12">
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">أهم المحاور</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label>النوع</label>
                                                    <select onchange="pointsType()" id="points_type" name="type" class="custom-select rounded-0">
                                                        <option value="-1">
                                                            اختر النوع
                                                        </option>
                                                        <option value="1">
                                                            تحميل ملف
                                                        </option>
                                                        <option value="2">
                                                            كتابة الرابط
                                                        </option>
                                                    </select>
                                                    @if ($errors->has('important_points_file'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ 'يجب عليك اختيار نوع أهم المحاور إما ملف او رابط' }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-12 imp-points" id="link" hidden>
                                                    <label>رابط الفيديو</label>
                                                    <input type="text" id="imp_link" name="important_points_link" class="form-control">
                                                    @if ($errors->has('important_points_link'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('important_points_link') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-12 imp-points" id="file_points" hidden>
                                                    <label>تحميل الملف</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input  id="imp_file" value="{{asset('reports/courses/'.$course->important_points)}}" type="file" class="custom-file-input" name="important_points_file">
                                                            <label class="custom-file-label"></label>
                                                        </div>
                                                    </div>
                                                    @if ($errors->has('important_points_file'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('important_points_file') }}</small>
                                                        </span>
                                                    @endif
                                                </div><br><br>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                        تعديل <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form><!-- /.form -->
                </div><!-- /.form-group -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.card-body -->
    </div><!-- /.card -->
    </div><!-- /.container-fluid -->
    </section>
    <div class="card-footer">
    Footer
    </div>
    </div><!-- /.content-header -->
    @endsection