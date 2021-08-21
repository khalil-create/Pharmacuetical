<<<<<<< HEAD
@php use App\Arrays\Arrays; @endphp
=======
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
@extends('layouts.index')
@section('title')
    ادارة المندوبين العلميين
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة المندوبين العلميين</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/managerMarketing/manageRepresentatives">ادارة المندوبيين</a></li>
                <li class="breadcrumb-item active">المندوبين العلميين</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
            <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                <h3 class="card-title" style="float: right">تعديل مندوب</h3>
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
                        <div class="form-group">
                            <form method="POST" action="/managerMarketing/updateRepresentative/{{$rep->user->id}}"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="card-body border">
                                    <div class="col-md-6">
                                        <input type="text" value="{{$rep->id}}" name="rep_id" hidden>
                                        <div class="khalil">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">الاسم</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-8">
<<<<<<< HEAD
                                                        <input type="text" value="{{ old('usernamethird',$rep->user->user_name_third) }}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
=======
                                                        <input type="text" value="{{$rep->user->user_name_third}}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('usernamethird'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-4">
<<<<<<< HEAD
                                                        <input type="text" value="{{ old('usersurname',$rep->user->user_surname) }}" name="usersurname" class="form-control" placeholder="اللقب">
=======
                                                        <input type="text" value="{{$rep->user->user_surname}}" name="usersurname" class="form-control" placeholder="اللقب">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('usersurname'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('usersurname') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <div class="form-group">
                                            <label for="usertype">الصفة الوظيفية </label>
                                                <select onchange="showListInRep()" id="usertype" name="usertype" class="custom-select rounded-0">
                                                    <option value="مندوب علمي"
<<<<<<< HEAD
                                                    {{ old('usertype',$rep->user->user_type) == 'مندوب علمي' ? 'selected':''}}>
                                                        مندوب علمي
                                                    </option>
                                                    <option value="مدير فريق"{{ old('usertype',$rep->user->user_type) == 'مدير فريق' ? 'selected':''}}>
=======
                                                    @if ($rep->user->user_type == 'مندوب علمي')
                                                        {{'selected'}}
                                                    @endif
                                                    >
                                                        مندوب علمي
                                                    </option>
                                                    <option value="مدير فريق"
                                                    @if ($rep->user->user_type == 'مدير فريق')
                                                        {{'selected'}}
                                                    @endif
                                                    >
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        مدير فريق
                                                    </option>
                                                </select>
                                                @if ($errors->has('usertype'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('usertype') }}</small>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">المشرف عليها</label>
                                            <select name="supervisor_id" id="supervisor_id" class="form-control custom-select rounded-0">
                                                @foreach ($supervisors as $row)
<<<<<<< HEAD
                                                <option value="{{$row->id}}" {{old('supervisor_id',$row->id) == $rep->supervisor_id ? 'selected':''}}>
                                                    {{ $row->user->user_name_third }} {{$row->user->user_surname}}
                                                </option>
=======
                                                <option value="{{$row->id}}" 
                                                    @if($row->id == $rep->supervisor_id) 
                                                        {{ 'selected' }}
                                                    @endif
                                                    >{{ $row->user->user_name_third }} {{$row->user->user_surname}}</option>
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                @endforeach
                                            </select>
                                            @if ($errors->has('supervisor_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('supervisor_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
<<<<<<< HEAD
=======
                                        {{-- @if($teamLeader)
                                            <div class="form-group" id="teemLeadersList" hidden>
                                                <label class="col-md-4 control-label">مدير الفريق</label>
                                                        <select id="teamleader" name="teemleader_id" class="form-control custom-select rounded-0">
                                                            @foreach($rep2 as $row)
                                                                @if($row->user_type == 'مدير فريق')
                                                                    <option value="{{$row->representatives->id}}">
                                                                        {{ $row->user_name_third }} {{$row->user_surname}}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @if ($errors->has('teemleader_id'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('teemleader_id') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label class="col-md-12 control-label">اختر منطقته الرئيسية</label>
                                            <select name="mainarea_id" class="form-control custom-select rounded-0">
                                                @foreach ($mainareas as $row)
                                                    <option value="{{$row->id}}"
                                                        @if ($row->id == $rep->mainarea_id)
                                                            {{'selected'}}
                                                        @endif
                                                        >{{$row->name_main_area}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('mainarea_id'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('mainarea_id') }}</small>
                                                </span>
                                            @endif
                                        </div> --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                        <div class="form-group">
                                            <label>الجنس</label>
                                            <div class="radiobox">
                                                <div class="form-check">
<<<<<<< HEAD
                                                    <input class="form-check-input" type="radio" value="ذكر" name="sex" checked>
                                                    <label class="form-check-label">ذكر</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sex" value="انثى" {{ old('sex') == 'انثى' ? 'checked':'' }}>
=======
                                                    <input class="form-check-input" type="radio" value="ذكر" name="sex" 
                                                    @if ($rep->user->sex=='ذكر')
                                                            {{'checked'}}
                                                    @endif
                                                    >
                                                    <label class="form-check-label">ذكر</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sex" value="انثى"
                                                    @if ($rep->user->sex=='انثى')
                                                            {{'checked'}}
                                                    @endif
                                                    >
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                    <label class="form-check-label">انثى</label>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="khalil">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">معلومات الهوية</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
<<<<<<< HEAD
                                                        <input type="text" value="{{ old('identitytype',$rep->user->identity_type) }}" name="identitytype" class="form-control" placeholder="نوع الهوية">
=======
                                                        <input type="text" value="{{$rep->user->identity_type}}" name="identitytype" class="form-control" placeholder="نوع الهوية">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('identitytype'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-6">
<<<<<<< HEAD
                                                        <input type="text" value="{{ old('identitynumber',$rep->user->identity_number) }}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
=======
                                                        <input type="text" value="{{$rep->user->identity_number}}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
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
                                    </div> <!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="khalil">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-7">
<<<<<<< HEAD
                                                        <input type="text" value="{{ old('email',$rep->user->email) }}" name="email" class="form-control" placeholder="البريد الإلكتروني">
=======
                                                        <input type="text" value="{{$rep->user->email}}" name="email" class="form-control" placeholder="البريد الإلكتروني">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-5">
<<<<<<< HEAD
                                                        <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{ old('phone_number',$rep->user->phone_number)}}" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
=======
                                                        <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{$rep->user->phone_number}}" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                        <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                        @if ($errors->has('phone_number'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('phone_number') }}</small>
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
                                                    <input type="file" value="{{asset('images/users/'.$rep->user->user_image)}}" class="custom-file-input" name="userimage">
                                                    <label class="custom-file-label" for="userimage"></label>
                                                </div>
                                            </div>
                                            @if ($errors->has('userimage'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="khalil">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
<<<<<<< HEAD
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">المحافظة</label>
                                                        <select name="birthplace" class="form-control custom-select rounded-0">
                                                            @foreach (Arrays::getAllCities() as $city)
                                                                <option value="{{$city}}" {{ old('birthplace',$rep->user->birthplace) == $city ? 'selected':'' }}>{{$city}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('birthplace'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('birthplace') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                    <label class="control-label">المديرية</label>
                                                        <input type="text" value="{{ old('town',$rep->user->town) }}" name="town" class="form-control" placeholder="المديرية">
                                                        @if ($errors->has('town'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">العزلة</label>
                                                        <input type="text" value="{{ old('village',$rep->user->village) }}" name="village" class="form-control" placeholder="العزلة">
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
                                            <label for="birthdate">تأريخ الميلاد</label>
                                            <input type="date" value="{{ old('birthdate',$rep->user->birthdate) }}" class="form-control" name="birthdate">
=======
                                                    <div class="col-4">
                                                    <input type="text" value="{{$rep->user->birthplace}}" name="birthplace" class="form-control" placeholder="المحافظة">
                                                    </div>
                                                    <div class="col-4">
                                                    <input type="text" value="{{$rep->user->town}}" name="town" class="form-control" placeholder="المديرية">
                                                    </div>
                                                    <div class="col-4">
                                                    <input type="text" value="{{$rep->user->village}}" name="village" class="form-control" placeholder="العزلة">
                                                    </div>
                                                </div>
                                            </div><!-- /.card-body -->
                                        </div>
                                        <div class="form-group">
                                            <label for="birthdate">تأريخ الميلاد</label>
                                            <input type="date" value="{{$rep->user->birthdate}}" class="form-control" name="birthdate">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                            @if ($errors->has('birthdate'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                                </span>
                                            @endif
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
                                                        <input onkeyup="checkPassword()" id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="التأكيد">
                                                        <small class="form-text text-danger" id="inalidPasswordConfirmation" hidden>{{'ليست متطابقه'}}</small>
                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div> <!-- /.card-body -->
                                        </div>
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-8">
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary font">
                                                تعديل <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </div><!-- /.col-md-8 -->
                                </div><!-- /.card-body -->
                            </form><!-- /.form -->
                        </div><!-- /.form-group -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="card-footer">
        Footer
    </div>
</div>
@endsection
@section('scripts')
    
@endsection