@extends('layouts.index')
@section('title')
    اضافة منطقة رئيسية
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
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
                            @if($supervisor->count() > 0)
                                <form method="POST" action="{{ url('supervisor/storeMainArea') }}"  enctype="multipart/form-data">
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
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                                اضافة <i class="fas fa-plus"></i>
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
                                {{ 'لايمكنك اضافة منطقة رئيسيه قبل مايتم اضافة على الاقل مشرف واحد' }}
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