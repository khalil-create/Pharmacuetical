@extends('layouts.index')
@section('title')
    اضافة دكتور
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
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

<!-- /.content-header -->
<div>
    <section class="content" >
            <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                <h3 class="card-title" style="float: right">إضافة دكتور</h3>
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
                    @if (session('error'))
                        <div class="alert alert-danger notify-error">
                            {{ session('error') }}
                        </div>
                    @endif
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <form method="POST" action="/representative/storeDoctor"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>اسم الدكتور</label>
                                <input type="text" name="name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">معلومات الاتصال</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <input id="phonenumber" type="text" name="mobile_phone" class="form-control" placeholder="رقم الهاتف">
                                                <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('mobile_phone'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('mobile_phone') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <input id="Tel_phone" type="text" name="clinic_phone" class="form-control" placeholder="تلفون العيادة">
                                                <small id="invalidClinicNo" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('clinic_phone'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('clinic_phone') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">مكان العمل</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="workplace_am" class="form-control" placeholder="الفترة الصباحية">
                                                @if ($errors->has('workplace_am'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('workplace_am') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="workplace_pm" class="form-control" placeholder="الفترة المسائية">
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
                            <div class="form-group">
                                <label>الولاء للمؤسسة </label>
                                    <select name="loyalty" class="custom-select rounded-0">
                                        <option value="1">
                                            A+
                                        </option>
                                        <option value="2">
                                            A
                                        </option>
                                        <option value="3">
                                            B+
                                        </option>
                                        <option value="4">
                                            B
                                        </option>
                                        <option value="5" selected>
                                            C
                                        </option>
                                    </select>
                                    @if ($errors->has('loyalty'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('loyalty') }}</small>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label>الرتبة</label>
                                <input type="text" name="rank" class="form-control">
                                @if ($errors->has('rank'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('rank') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>العنوان</label>
                                <input type="text" name="address" class="form-control">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    اضافة <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                        <!-- /.form-group -->
                    </form>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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
</div>
@endsection
@section('scripts')
    
@endsection