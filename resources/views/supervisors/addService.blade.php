@extends('layouts.index')
@section('title')
    ادارة الخدمات
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الخدمات</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">الخدمات</li>
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
                <h3 class="card-title" style="float: right">إضافة خدمة</h3>
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
                        <form method="POST" action="/supervisor/storeService"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>نوع الخدمة</label>
                                <select onchange="showServiceName()" id="service_type" name="type" class="custom-select rounded-0">
                                    <option value="0">
                                        عيني
                                    </option>
                                    <option value="1">
                                        مادي
                                    </option>
                                </select>
                            </div>
                            <div id="service_name" class="form-group" hidden>
                                <label>اسم الخدمة</label>
                                <input id="name" type="text" name="name" class="form-control" value="write servic name">
                                @if (session('error'))
                                    <div class="alert alert-danger notify-error">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>تكلفة الخدمة</label>
                                <input type="text" name="cost" class="form-control">
                                @if ($errors->has('cost'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('cost') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>نوع العميل</label>
                                <select onchange="showCustType()" id="cust_type" name="cust_type" class="custom-select rounded-0">
                                    <option value="-1">
                                        اختر نوع العميل
                                    </option>
                                    @if($customers->count() > 0)
                                        <option value="0">
                                            عميل (صيدلية-مستشفى)
                                        </option>
                                    @endif
                                    @if($doctors->count() > 0)
                                        <option value="1">
                                            دكتور
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div id="cust_name" class="form-group" hidden>
                                <label>اسم العميل <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من عميل)</span></label>
                                <select  name="cust_ids[]" class="custom-select rounded-0" multiple>
                                    @foreach ($customers as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="doctor_name" class="form-group" hidden>
                                <label>اسم الدكتور <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من دكتور)</span></label>
                                <select name="doctor_ids[]" class="custom-select rounded-0" multiple>
                                    @foreach ($doctors as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">اسم المندوب</label>
                                <select name="rep_id" class="form-control custom-select rounded-0">
                                    @foreach ($reps as $rep)
                                        <option value="{{$rep->id}}">{{$rep->user->user_name_third}} {{$rep->user->user_surname}}</option>
                                    @endforeach
                                </select>
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