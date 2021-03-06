@php use App\Arrays\Arrays; @endphp
@extends('layouts.index')
@section('title')
    ادارة المشرفين
@endsection
@section('content')
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">ادارة المشرفين</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/managerMarketing/manageSupervisors">ادارة المشرفين</a></li>
                <li class="breadcrumb-item active">المشرفين</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل بيانات المشرف</h3>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-tools float-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div> <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="form-group">
                            <form action="/managerMarketing/supervisorUpdate/{{$user->id}}" class="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="col-md-6">
                                    <div class="khalil">
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">الاسم</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-8">
<<<<<<< HEAD
                                                    <input type="text" value="{{ old('usernamethird',$user->user_name_third) }}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
=======
                                                    <input type="text" value="{{$user->user_name_third}}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                    @if ($errors->has('usernamethird'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-4">
<<<<<<< HEAD
                                                    <input type="text" value="{{ old('usersurname',$user->user_surname) }}" name="usersurname" class="form-control" placeholder="اللقب">
=======
                                                    <input type="text" value="{{$user->user_surname}}" name="usersurname" class="form-control" placeholder="اللقب">
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
                                        <label for="">الجنس</label>
                                        <?php
                                            $male = '';
                                            $female = '';
                                            if($user->sex == 'ذكر') $male = 'checked';
                                            else $female = 'checked';
                                        ?>
                                        <div class="radiobox">
                                            <div class="form-check">
<<<<<<< HEAD
                                                <input class="form-check-input" type="radio" value="ذكر" name="sex" {{ old('sex',$user->sex) == 'ذكر' ? 'checked':'' }}>
                                                <label class="form-check-label">ذكر</label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sex" value="انثى" {{ old('sex',$user->sex) == 'انثى' ? 'checked':'' }}>
=======
                                                <input class="form-check-input" type="radio" {{$male}} value="ذكر" name="sex">
                                                <label class="form-check-label">ذكر</label>
                                            </div>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" {{$female}} name="sex" value="انثى">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                            <label class="form-check-label"> {{$female}}انثى</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="userimage">تحميل الصورة</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" value="{{asset('images/users/'.$user->user_image)}}" name="userimage">
                                                <label class="custom-file-label" for="userimage"></label>
                                                @if ($errors->has('userimage'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('userimage') }}</small>
                                                    </span>
                                                @endif
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
                                                    <input type="text" value="{{ old('identitytype',$user->identity_type) }}" name="identitytype" class="form-control" placeholder="نوع الهوية">
=======
                                                    <input type="text" value="{{$user->identity_type}}" name="identitytype" class="form-control" placeholder="نوع الهوية">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                    @if ($errors->has('identitytype'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-6">
<<<<<<< HEAD
                                                    <input type="text" value="{{ old('identitynumber',$user->identity_number)}}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
=======
                                                    <input type="text" value="{{$user->identity_number}}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="khalil">
<<<<<<< HEAD
=======
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" value="{{$user->birthplace}}" name="birthplace" class="form-control" placeholder="المحافظة">
                                                    @if ($errors->has('birthplace'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('birthplace') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" value="{{$user->town}}" name="town" class="form-control" placeholder="المديرية">
                                                    @if ($errors->has('town'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" value="{{$user->village}}" name="village" class="form-control" placeholder="العزلة">
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
                                        <input type="date" class="form-control" value="{{$user->birthdate}}" name="birthdate">
                                        @if ($errors->has('birthdate'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="khalil">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-7">
                                                    <input type="text" value="{{old('email',$user->email) }}" name="email" class="form-control" placeholder="البريد الإلكتروني">
                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-5">
<<<<<<< HEAD
                                                    <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{ old('phone_number',$user->phone_number) }}" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
=======
                                                    <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{$user->phone_number}}" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                    <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                    @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('phone_number') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <div class="khalil">
                                        <div class="card-header">
<<<<<<< HEAD
                                            <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
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
                                                    <input type="text" value="{{ old('town',$user->town) }}" name="town" class="form-control" placeholder="المديرية">
                                                    @if ($errors->has('town'))
                                                        <span class="help-block">
                                                            <small class="form-text text-danger">{{ $errors->first('town') }}</small>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="control-label">العزلة</label>
                                                    <input type="text" value="{{ old('village',$user->village) }}" name="village" class="form-control" placeholder="العزلة">
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
                                        <input type="date" class="form-control" value="{{$user->birthdate}}" name="birthdate">
                                        @if ($errors->has('birthdate'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="khalil">
                                        <div class="card-header">
=======
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
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
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" >
                                        <button type="submit" class="btn btn-primary font">
                                            تعديل <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.form-group -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div> <!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="card-footer">
        Footer
    </div><!-- card-footer -->
</div>
@endsection
@section('scripts')
    
@endsection