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
                            <form method="POST" action="{{ url('storeMainArea') }}"  enctype="multipart/form-data">
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
                                <input id="supervisor_name_hidden" type="text" name="supervisor_name_hidden" hidden>
                                <div class="form-group{{ $errors->has('supervisor_name') ? ' has-error' : '' }}">
                                    <label for="supervisor_name" class="col-md-2 control-label">المشرف عليها</label>
                                    {{-- <div class="col-md-8"> --}}
                                        {{-- <input name="supervisor_name"  id="supervisor_name" list="usertype" > --}}
                                            <select name="supervisor_name" id="supervisor_name" class="form-control custom-select rounded-0">
                                                @foreach ($supervisor as $sup)
                                                <option value="{{$sup->user_name_third}}">{{ $sup->user_name_third }} {{$sup->user_surname}}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('supervisor_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('supervisor_name') }}</strong>
                                            </span>
                                        @endif
                                    {{-- </div> --}}
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