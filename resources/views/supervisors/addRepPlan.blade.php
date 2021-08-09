@extends('layouts.index')
@section('title')
    ادارة الخطط
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الخطط</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">الخطط</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    <section class="content" >
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default" style="margin-left: 20px;">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">إضافة خطة</h3>
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
                                    <form method="POST" action="/supervisor/storeRepPlan" onsubmit="return checkPlan()"  enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">المندوب</label>
                                                <select name="rep_id" class="form-control custom-select rounded-0">
                                                    @foreach ($reps as $rep)
                                                        <option value="{{$rep->id}}">{{$rep->user->user_name_third}} {{$rep->user->user_surname}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>شهر الخطة</label>
                                                <select id="plan_month" name="plan_month" class="custom-select rounded-0">
                                                    <option value="-1">
                                                        اختر شهر الخطة
                                                    </option>
                                                    <option value="1">
                                                        يناير
                                                    </option>
                                                    <option value="2">
                                                        فبراير
                                                    </option>
                                                    <option value="3">
                                                        مارس
                                                    </option>
                                                    <option value="4">
                                                        ابريل
                                                    </option>
                                                    <option value="5">
                                                        مايو
                                                    </option>
                                                    <option value="6">
                                                        يونيو
                                                    </option>
                                                    <option value="7">
                                                        يوليو
                                                    </option>
                                                    <option value="8">
                                                        أغسطس
                                                    </option>
                                                    <option value="9">
                                                        سبتمبر
                                                    </option>
                                                    <option value="10">
                                                        أكتوبر
                                                    </option>
                                                    <option value="11">
                                                        نوفمبر
                                                    </option>
                                                    <option value="12">
                                                        ديسمبر
                                                    </option>
                                                </select>
                                            </div>
                                            <div id="cust_name" class="form-group">
                                                <label>نوع الخطة</label>
                                                <select id="plan_type"  name="plan_type_id" class="custom-select rounded-0">
                                                    <option value="-1">اختر نوع الخطة</option>
                                                    @foreach ($plan_types as $row)
                                                        <option value="{{$row->id}}">
                                                            {{$row->plan_type_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>تأريخ الخطة</label>
                                                <input type="date" class="form-control" name="plan_date">
                                                @if ($errors->has('plan_date'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('plan_date') }}</small>
                                                    </span>
                                                @endif
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