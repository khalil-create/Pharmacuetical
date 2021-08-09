@extends('layouts.index')
@section('title')
    ادارة الخطط
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الخطط</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الخطط</li>
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
                    <h3 class="card-title" style="float: right">إضافة نوع خطة</h3>
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
                            <form method="POST" action="{{ url('admin/storePlanType') }}"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_main_area">اسم نوع الخطة</label>
                                        <input type="text" name="plan_type_name" class="form-control" id="name_main_area">
                                        @if ($errors->has('plan_type_name'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('plan_type_name') }}</small>
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
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection