@extends('layouts.index')
@section('title')
    ادارة التخصصات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة التخصصات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">تخصصات الاطباء</li>
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
                    <h3 class="card-title" style="float: right">تعديل تخصص</h3>
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
                                <form method="POST" action="{{ url('admin/updateSpecialist',$specialist->id) }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>اسم التخصص</label>
                                            <input type="text" value="{{$specialist->name}}" name="name" class="form-control">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                                تعديل<i class="fas fa-edit"></i>
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
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection