@extends('layouts.index')
@section('title')
    اضافة عينة
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
                    <h3 class="card-title" style="float: right">إضافة عينة</h3>
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
                            <form method="POST" action="{{ url('managerMarketing/storeSample') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>العينة</label>
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
                                <div class="form-group">
                                    <label for="count">الكمية</label>
                                    <input type="text" name="count" class="form-control">
                                    @if ($errors->has('count'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('count') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="supervisor_id" class="col-md-2 control-label">المشرف</label>
                                            <select name="supervisor_id" class="form-control custom-select rounded-0">
                                                @foreach ($supervisors as $row)
                                                    <option value="{{$row->id}}">{{ $row->user->user_name_third }} {{$row->user->user_surname}}</option>
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
                                        اضافة <i class="fas fa-plus"></i>
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