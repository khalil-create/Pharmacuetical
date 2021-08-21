@extends('layouts.index')
@section('title')
    ادارة الاطباء
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الاطباء</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/manageDoctors">ادارة الاطباء</a></li>
                    <li class="breadcrumb-item active">الاطباء</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل طبيب</h3>
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
                        <form method="POST" action="/admin/updateDoctor/{{$doctor->id}}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body border">
                            <div class="form-group col-md-6">
                                <label>اسم الطبيب</label>
                                <input value="{{$doctor->name}}" type="text" name="name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    </span>
                                @endif
                                <label class="control-label">المندوب العلمي</label>
                                <select name="rep_id" class="form-control custom-select rounded-0">
                                    @foreach ($reps as $rep)
                                        <option value="{{$rep->id}}"
                                            @if ($doctor->representative_id == $rep->id)
                                                {{'selected'}}
                                            @endif
                                            >{{$rep->user->user_name_third}} {{$rep->user->user_surname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>تخصص الطبيب <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من تخصص)</span></label>
                                <select name="specialist_ids[]" class="custom-select rounded-0" multiple>
                                    @foreach ($specialists as $specialist)
                                        <option value="{{$specialist->id}}">{{$specialist->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('specialist_ids'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('specialist_ids') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    @php
                                        $AA='';$A='';$BB='';$B='';$C='';
                                        if($doctor->loyalty == 1)
                                            $AA = 'selected';
                                        else if($doctor->loyalty == 2)
                                            $A = 'selected';
                                        else if($doctor->loyalty == 3)
                                            $BB = 'selected';
                                        else if($doctor->loyalty == 4)
                                            $B = 'selected';
                                        else
                                            $C = 'selected';
                                    @endphp
                                    <label>الولاء للمؤسسة </label>
                                        <select name="loyalty" class="custom-select rounded-0">
                                            <option value="1" {{$AA}}>
                                                A+
                                            </option>
                                            <option value="2" {{$A}}>
                                                A
                                            </option>
                                            <option value="3" {{$BB}}>
                                                B+
                                            </option>
                                            <option value="4" {{$B}}>
                                                B
                                            </option>
                                            <option value="5" {{$C}}>
                                                C
                                            </option>
                                        </select>
                                        @if ($errors->has('loyalty'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('loyalty') }}</small>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group col-md-4">
                                    @php
                                        $AA='';$A='';$BB='';$B='';$C='';$Z='';
                                        if($doctor->rank == 1)
                                            $AA = 'selected';
                                        else if($doctor->rank == 2)
                                            $A = 'selected';
                                        else if($doctor->rank == 3)
                                            $BB = 'selected';
                                        else if($doctor->rank == 4)
                                            $B = 'selected';
                                        else if($doctor->rank == 5)
                                            $C = 'selected';
                                        else
                                            $Z = 'selected';
                                    @endphp
                                    <label>الرتبة</label>
                                    <select name="rank" class="custom-select rounded-0">
                                        <option value="1" {{$AA}}>
                                            A+
                                        </option>
                                        <option value="2" {{$A}}>
                                            A
                                        </option>
                                        <option value="3" {{$BB}}>
                                            B+
                                        </option>
                                        <option value="4" {{$B}}>
                                            B
                                        </option>
                                        <option value="5" {{$C}}>
                                            C
                                        </option>
                                        <option value="5" {{$Z}}>
                                            Z
                                        </option>
                                    </select>
                                    @if ($errors->has('rank'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('rank') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label>العنوان</label>
                                    <input value="{{$doctor->address}}" type="text" name="address" class="form-control">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input id="phonenumber"  onkeyup="checkPhoneNumber()" value="{{$doctor->mobile_phone}}" type="text" name="mobile_phone" class="form-control" placeholder="رقم الهاتف">
                                                <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('mobile_phone'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('mobile_phone') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input onkeyup="checkTelPhoneDoctor()" id="Tel_phone" value="{{$doctor->clinic_phone}}" type="text" name="clinic_phone" class="form-control" placeholder="تلفون العيادة">
                                                <small id="invalidClinicNo" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('clinic_phone'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('clinic_phone') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">مكان العمل</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input value="{{$doctor->workplace_am}}" type="text" name="workplace_am" class="form-control" placeholder="الفترة الصباحية">
                                                @if ($errors->has('workplace_am'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('workplace_am') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input value="{{$doctor->workplace_pm}}" type="text" name="workplace_pm" class="form-control" placeholder="الفترة المسائية">
                                                @if ($errors->has('workplace_pm'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('workplace_pm') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12" >
                                <button type="submit" class="btn btn-primary font">
                                    تعديل <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
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
</div><!-- /.content-header -->
@endsection
@section('scripts')
    
@endsection