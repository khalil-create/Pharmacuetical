@extends('layouts.index')
@section('title')
    ادارة الدراسات العلمية
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الدراسات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الدراسات العلمية</li>
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
                    <h3 class="card-title" style="float: right">إضافة دراسة علمية</h3>
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
                            <form method="POST" action="{{ url('supervisor/storeStudy') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">عنوان الدراسة</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="source">الجهة المحكمة</label>
                                    <input type="text" name="source" class="form-control" id="source">
                                    @if ($errors->has('source'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('source') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="emission_date">سنة الاصدار</label>
                                    <input type="date" class="form-control" name="emission_date">
                                    @if ($errors->has('emission_date'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('emission_date') }}</small>
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