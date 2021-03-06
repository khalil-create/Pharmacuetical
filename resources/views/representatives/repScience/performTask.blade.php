@extends('layouts.index')
@section('title')
    ادارة المهام
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المهام</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">المهام</li>
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
                    <h3 class="card-title" style="float: right">إضافة تقرير انجاز المهمة</h3>
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
                            @if(isset($task))
                                <form method="POST" action="/repScience/storePerformTask/{{$task->id}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <small class="btn btn-danger form-text" style="margin-bottom: 15px">{{'يجب عليك تعبئة حقل واحد فقط، إما كتابة تقرير بشكل نصي او يمكنك تحميل ملف تقريرك اذا كان يشتمل على نص كبير'}}</small>
                                        <div class="form-group">
                                            <label>تقرير انجاز المهمة</label>
                                            {{-- <input type="text" name="report_task_text" class="form-control"> --}}
                                            <textarea name="report_task_text" id="form" cols="30" rows="4" class="form-control"></textarea>
                                            @if ($errors->has('report_task_text'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('report_task_text') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>تحميل الملف</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="report_task_file">
                                                    <label class="custom-file-label"></label>
                                                </div>
                                            </div>
                                            @if ($errors->has('report_task_file'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('report_task_file') }}</small>
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
                            @else
                                <div class="alert alert-danger notify-error">
                                    {{ 'لايمكنك اضافة التقرير قبل مايتم اضافة على الاقل ' }}
                                </div>
                            @endif
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