@extends('layouts.index')
@section('title')
    ادارة الشركات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الشركات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الشركات</li>
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
                    <h3 class="card-title" style="float: right">إضافة شركة</h3>
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
                            <form method="POST" action="{{ url('managerMarketing/companyStore') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name_company">اسم الشركة</label>
                                    <input type="text" name="name_company" class="form-control" id="name_company">
                                    @if ($errors->has('name_company'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('name_company') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="country_manufacturing">بلد التصنيع</label>
                                    <input type="text" name="country_manufacturing" class="form-control" id="country_manufacturing">
                                    @if ($errors->has('country_manufacturing'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('country_manufacturing') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="sign_img_company">تحميل الصورة</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="sign_img_company">
                                            <label class="custom-file-label" for="sign_img_company"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">لديها مجموعة اصناف</label>
                                    <div class="radiobox">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="have_category" checked>
                                            <label class="form-check-label">نعم</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="have_category" value="0">
                                            <label class="form-check-label">لا</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('have_category'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('have_category') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">المشرف عليها</label>
                                            <select name="supervisor_id" id="supervisor_id" class="form-control custom-select rounded-0">
                                                @foreach ($supervisor as $row)
                                                <option value="{{$row->id}}">{{ $row->user->user_name_third }} {{$row->user->user_surname}}</option>
                                                @endforeach
                                            </select>
                                        @if ($errors->has('supervisor_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('supervisor_id') }}</strong>
                                            </span>
                                        @endif
                                    {{-- </div> --}}
                                </div>
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                        حفظ<i class="fas fa-plus"></i>
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