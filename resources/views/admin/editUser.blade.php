@php use App\Arrays\Arrays; @endphp
@extends('layouts.index')
@section('title')
    ادارة المستخدمين
@endsection

@section('content')
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">ادارة المستخدمين</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/displayAllUsers">ادارة المستخدمين</a></li>
                    <li class="breadcrumb-item active">حسابات المستخدمين</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل بيانات المستخدم</h3>
                    <div class="card-tools float-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <form action="/admin/userUpdate/{{$user->id}}" class="form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="card-body border">
                                        <div class="col-md-6">
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">الاسم</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <input type="text" value="{{old('usernamethird',$user->user_name_third)}}" name="usernamethird" class="form-control" placeholder="الاسم الثلاثي">
                                                            @if ($errors->has('usernamethird'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('usernamethird') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="text" value="{{old('usersurname',$user->user_surname)}}" name="usersurname" class="form-control" placeholder="اللقب">
                                                            @if ($errors->has('usersurname'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('usersurname') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                            <div class="form-group">
                                                <label for="usertype">الصفة الوظيفية</label>
                                                    <select onchange="showList()" name="usertype" class="custom-select rounded-0" id="usertype">
                                                        <?php
                                                            $usertype = 'selected';
                                                        ?>
                                                        @if($user->user_type == 'مدير تسويق' || $user->user_type == 'مدير مبيعات')
                                                            <option value="مدير تسويق"
                                                                {{ old('usertype',$user->user_type) == 'مدير تسويق' ? 'selected':''}}
                                                                >
                                                                مدير تسويق
                                                            </option>
                                                        @endif
                                                        @if($user->user_type == 'مدير مبيعات' || $user->user_type == 'مدير تسويق')
                                                            <option value="مدير مبيعات"
                                                            {{ old('usertype',$user->user_type) == 'مدير مبيعات' ? 'selected':''}}>
                                                                مدير مبيعات
                                                            </option>
                                                        @else
                                                            <option value="مشرف"
                                                            {{ old('usertype',$user->user_type) =='مشرف' ? 'selected':''}}>
                                                                مشرف
                                                            </option>
                                                            @if($supervisors)
                                                                <option value="مدير فريق"
                                                            {{ old('usertype',$user->user_type) == 'مدير فريق' ? 'selected':''}}>
                                                                    مدير فريق
                                                                </option>
                                                                <option value="مندوب علمي"
                                                                {{ old('usertype', $user->user_type) == 'مندوب علمي' ? 'selected' : ' '}}>
                                                                    مندوب علمي
                                                                </option>
                                                            @endif
                                                            {{-- @if($teemLeaders->count() > 0 || $teemLeaders->count() > 0)
                                                            @endif --}}
                                                            <option value="مندوب مبيعات"
                                                            {{ old('usertype',$user->user_type) == 'مندوب مبيعات' ? 'selected':''}}>
                                                                مندوب مبيعات
                                                            </option>
                                                        @endif
                                                    </select>
                                                @if ($errors->has('usertype'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('usertype') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            @if($supervisors)
                                                <div class="form-group" id="supervisor" {{(old('usertype',$user->user_type) != 'مندوب علمي' && old('usertype',$user->user_type) != 'مدير فريق') ? 'hidden' : ''}}>
                                                    <label for="supervisor_id" class="col-md-4 control-label">المشرف</label>
                                                    <select name="supervisor_id" class="form-control custom-select rounded-0">
                                                        @foreach($supervisors as $row)
                                                            @if($row->user_id != $user->id)
                                                                <option value="{{$row->id}}" {{old('supervisor_id') == $row->id ? 'selected':''}}>{{ $row->user->user_name_third }} {{$row->user->user_surname}}</option>
                                                            @endif
                                                            @endforeach
                                                    </select>
                                                    @if ($errors->has('supervisor_id'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('supervisor_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> 
                                            @endif
                                            <div class="form-group">
                                                <label>الجنس</label>
                                                <div class="radiobox">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="ذكر" name="sex" {{ old('sex',$user->sex) == 'ذكر' ? 'checked':'' }}>
                                                        <label class="form-check-label"
                                                        @if ($user->sex=='ذكر')
                                                            {{$sex}}
                                                        @endif
                                                        >ذكر</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="sex" value="انثى" {{ old('sex',$user->sex) == 'انثى' ? 'checked':'' }}>
                                                        <label class="form-check-label"
                                                        @if ($user->sex=='انثى')
                                                            {{$sex}}
                                                        @endif
                                                        >انثى</label>
                                                    </div>
                                                </div>
                                                @if ($errors->has('sex'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('sex') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">معلومات الهوية</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="text" value="{{ old('identitytype',$user->identity_type) }}" name="identitytype" class="form-control" placeholder="نوع الهوية">
                                                            @if ($errors->has('identitytype'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('identitytype') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="text" value="{{ old('identitynumber',$user->identity_number) }}" name="identitynumber" class="form-control" placeholder="رقم الهوية">
                                                            @if ($errors->has('identitynumber'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('identitynumber') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <input type="text" value="{{ old('email',$user->email) }}" name="email" class="form-control" placeholder="البريد الإلكتروني">
                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="col-5">
                                                            <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{ old('phone_number',$user->phone_number) }}" type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف">
                                                            <small id="invalidPhoneNo" class="form-text text-danger"></small>
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
                                            </div>
                                            <div class="form-group">
                                                <label for="birthdate">تأريخ الميلاد</label>
                                                <input type="date" class="form-control" value="{{ old('birthdate',$user->birthdate) }}" name="birthdate">
                                                @if ($errors->has('birthdate'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('birthdate') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="khalil">
                                                <div class="card-header">
                                                    <h3 class="card-title" style="float: right">مكان الميلاد</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label class="control-label">المحافظة</label>
                                                            <select name="birthplace" class="form-control custom-select rounded-0">
                                                                @foreach (Arrays::getAllCities() as $city)
                                                                    <option value="{{$city}}" {{ old('birthplace',$user->birthplace) == $city ? 'selected':'' }}>{{$city}}</option>
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
                                                </div><!-- /.card-body -->
                                            </div>
                                        </div><!-- /.col -->
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary font">
                                                تعديل <i class="fas fa-edit"></i>
                                            </button>
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
    <div class="card-footer">
        Footer
    </div>
</div>
@endsection
@section('scripts')
    
@endsection