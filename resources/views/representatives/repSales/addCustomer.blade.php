@extends('layouts.index')
@section('title')
    ادارة العملاء
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة العملاء</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">العملاء</li>
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
                <h3 class="card-title" style="float: right">إضافة عميل</h3>
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
                        <form method="POST" action="/repSales/storeCustomer"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>نوع العميل</label>
                                    <select name="type" class="custom-select rounded-0">
                                        <option value="0">
                                            مستشفى
                                        </option>
                                        <option value="1">
                                            صيدلية
                                        </option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('type') }}</small>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label>اسم العميل</label>
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
                                        <h3 class="card-title" style="float: right">معلومات المالك</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="text" name="owner_name" class="form-control" placeholder="اسم المالك">
                                                @if ($errors->has('owner_name'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('owner_name') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <input id="phonenumber"  onkeyup="checkPhoneNumber()" type="text" name="owner_phone" class="form-control" placeholder="رقم هاتف المالك">
                                                <small id="invalidPhoneNo" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('owner_phone'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('owner_phone') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-4">
                                                <input onkeyup="checkTelPhoneOwner()" id="Tel_phone_Owner" type="text" name="owner_tel" class="form-control" placeholder="تلفون المالك الأرضي">
                                                <small id="invalidOwnerNo" class="form-text text-danger"></small>
                                                @if ($errors->has('owner_tel'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('owner_tel') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="form-group">
                                <label>حجم العميل </label>
                                    <select name="size" class="custom-select rounded-0">
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
                                    @if ($errors->has('size'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('size') }}</small>
                                        </span>
                                    @endif
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
                                <label>العنوان</label>
                                <input type="text" name="address" class="form-control">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('address') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="khalil">
                                    <div class="card-header">
                                        <h3 class="card-title" style="float: right">معلومات موظف الاتصال</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <input type="text" name="contact_official_name" class="form-control" placeholder="اسم مسؤول الاتصال">
                                                @if ($errors->has('contact_official_name'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('contact_official_name') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="contact_official_type" class="form-control" placeholder="الموقع الوظيفي لمسؤول الاتصال">
                                                @if ($errors->has('contact_official_type'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('contact_official_type') }}</small>
                                                    </span>
                                                @endif
                                            </div><br><br>
                                            <div class="col-6">
                                                <input onkeyup="checkTel()" id="Tel_Contact" type="text" name="contact_official_tel" class="form-control" placeholder="رقم الهاتف المحمول لمسؤول الاتصال">
                                                <small id="invalidContactTel" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('contact_official_tel'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('contact_official_tel') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <input onkeyup="checkTelPhoneContact()" id="Tel_phone_Contact" type="text" name="contact_official_phone" class="form-control" placeholder="رقم الهاتف الأرضي لمسؤول الاتصال">
                                                <small id="invalidContactPhone" class="form-text text-danger" hidden></small>
                                                @if ($errors->has('contact_official_phone'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('contact_official_phone') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="form-group" >
                                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                                    حفظ<i class="fas fa-save"></i>
                                                </button>
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