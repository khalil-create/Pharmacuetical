@extends('layouts.index')
@section('title')
    ادارة المشرفين
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة المشرفين</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">المشرفين</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">إضافة مشرف</h3>
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
                                <form method="POST" action="{{ url('managerMarketing/storeSupervisor') }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body border">
                                        <div class="col-md-6">
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">الاسم <span class="text-danger">*</span></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <input type="text" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي" value="{{ old('usernamethird') }}">
                                                            @if ($errors->has('usernamethird'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" name="usersurname" class="form-control" placeholder="اللقب" value="{{ old('usersurname') }}">
                                                            @if ($errors->has('usersurname'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('usersurname') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="col-md-12 control-label">اختر مناطق الاشراف</label>
                                                <select name="mainarea_ids[]" class="form-control custom-select rounded-0" multiple>
                                                    @foreach ($mainareas as $row)
                                                        <option value="{{$row->id}}">{{$row->name_main_area}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('mainarea_ids'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('mainarea_ids') }}</small>
                                                    </span>
                                                @endif
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="">الجنس <span class="text-danger">*</span></label>
                                                <div class="radiobox">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="ذكر" name="sex" checked value="{{ old('sex') }}">
                                                        <label class="form-check-label">ذكر</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sex" value="انثى" value="{{ old('sex') }}">
                                                        <label class="form-check-label">انثى</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">كلمة السر</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input id="password" type="password" name="password" class="form-control" placeholder="كلمة السر">
                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-6">
                                                            <input onkeyup="checkPassword()" id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="التأكيد" >
                                                            <small class="form-text text-danger" id="inalidPasswordConfirmation" hidden>{{'ليست متطابقه'}}</small>
                                                            @if ($errors->has('password_confirmation'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div><!-- /.col-md -->
                                        <div class="col-md-6">
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">معلومات الاتصال <span class="text-danger">*</span></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <input type="text" name="email" class="form-control" placeholder="البريد الإلكتروني" value="{{ old('email') }}">
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-5">
                                                            <input id="phonenumber" onkeyup="checkPhoneNumber()" type="text" name="phonenumber" class="form-control" placeholder="رقم الهاتف" value="{{ old('phonenumber') }}">
                                                            <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                            @if ($errors->has('phonenumber'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('phonenumber') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            <div class="form-group">
                                                <label for="userimage">تحميل الصورة</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="userimage" value="{{ old('userimage') }}">
                                                        <label class="custom-file-label" for="userimage"></label>
                                                        @if ($errors->has('userimage'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">مكان الميلاد <span class="text-danger">*</span></h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <input type="text" name="birthplace" class="form-control" placeholder="المحافظة" value="{{ old('birthplace') }}">
                                                            @if ($errors->has('birthplace'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('birthplace') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" name="town" class="form-control" placeholder="المديرية" value="{{ old('town') }}">
                                                            @if ($errors->has('town'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" name="village" class="form-control" placeholder="العزلة" value="{{ old('village') }}">
                                                            @if ($errors->has('village'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('village') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="birthdate">تأريخ الميلاد <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}">
                                                    @if ($errors->has('birthdate'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <div class="khalil">
                                                        <div class="card-header">
                                                            <h3 class="card-title" style="float: right">معلومات الهوية <span class="text-danger">*</span></h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <input type="text" name="identitytype" class="form-control" placeholder="نوع الهوية" value="{{ old('identitytype') }}">
                                                                    @if ($errors->has('identitytype'))
                                                                        <span class="help-block">
                                                                            <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="text" name="identitynumber" class="form-control" placeholder="رقم الهوية" value="{{ old('identitynumber') }}">
                                                                    @if ($errors->has('identitynumber'))
                                                                        <span class="help-block">
                                                                            <small class="form-text text-danger">{{ $errors->first('identitynumber') }}</small>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group" >
                                                <button type="submit" class="btn btn-primary font" style="margin:20px 0px -15px">
                                                    حفظ<i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div><!-- /.card-body -->
                                </form><!-- /.form -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection
