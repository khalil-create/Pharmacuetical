@extends('layouts.index')
@section('title')
    ادارة الاهداف البيعية 
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاهداف البيعية</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الاهداف البيعية</li>
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
                    <h3 class="card-title" style="float: right">إضافة هدف بيعي</h3>
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
                            <form method="POST" action="{{ url('managerMarketing/storeSalesObjective') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>الصنف</label>
                                        <select name="item_id" class="form-control custom-select rounded-0">
                                            @foreach ($items as $row)
                                                    <option value="{{$row->id}}">{{ $row->commercial_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('item_id'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('item_id') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="objective">مقدار الهدف</label>
                                        <input type="text" name="objective" class="form-control">
                                        @if ($errors->has('objective'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('objective') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description">الوصف</label>
                                        <input type="text" name="description" class="form-control">
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('description') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                </div><!-- /.row -->
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-primary font">
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