@extends('layouts.index')
@section('title')
    ادارة الاختبارات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاختبارات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الاختبارات</li>
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
                    <h3 class="card-title" style="float: right">تعديل اختبار</h3>
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
                            <form method="POST" action="/supervisor/updateTest/{{$test->id}}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>اسم الاختبار</label>
                                    <input value="{{$test->test_name}}" type="text" name="test_name" class="form-control" id="name_cat">
                                    @if ($errors->has('test_name'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('test_name') }}</small>
                                        </span>
                                    @endif
                                </div>
                                {{-- @php
                                    $TorF = '';
                                    $Choices = '';
                                    if($test->type == 0)
                                        $TorF = 'selected';
                                    else
                                        $Choices = 'selected';
                                @endphp
                                <div class="form-group">
                                    <label class="col-md-2 control-label">نوع الاختبار</label>
                                        <select name="type" class="form-control custom-select rounded-0">
                                            <option value="0" {{$TorF}}>{{'صواب/خطأ'}}</option>
                                            <option value="1" {{$Choices}}>{{'اختيار متعدد'}}</option>
                                        </select>
                                        @if ($errors->has('type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif
                                </div> --}}
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