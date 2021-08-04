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

<!-- /.content-header -->
<div>
    <section class="content" >
            <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                <h3 class="card-title" style="float: right">تعديل خطة</h3>
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
                        <form method="POST" action="/repScience/updatePlan/{{$plan->id}}" onsubmit="return checkPlan()"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>شهر الخطة</label>
                                @php
                                    $month1='';$month2='';$month3='';$month4='';$month5='';$month6='';
                                    $month7='';$month8='';$month9='';$month10='';$month11='';$month12='';
                                    if($plan->plan_month == 1) $month1 = 'selected';
                                    else if($plan->plan_month == 2) $month2 = 'selected';
                                    else if($plan->plan_month == 3) $month3 = 'selected';
                                    else if($plan->plan_month == 4) $month4 = 'selected';
                                    else if($plan->plan_month == 5) $month5 = 'selected';
                                    else if($plan->plan_month == 6) $month6 = 'selected';
                                    else if($plan->plan_month == 7) $month7 = 'selected';
                                    else if($plan->plan_month == 8) $month8 = 'selected';
                                    else if($plan->plan_month == 9) $month9 = 'selected';
                                    else if($plan->plan_month == 10) $month10 = 'selected';
                                    else if($plan->plan_month == 11) $month11 = 'selected';
                                    else if($plan->plan_month == 12) $month12 = 'selected';
                                @endphp
                                <select id="plan_month" name="plan_month" class="custom-select rounded-0">
                                    <option value="-1">
                                        اختر شهر الخطة
                                    </option>
                                    <option value="1" {{$month1}}>
                                        يناير
                                    </option>
                                    <option value="2" {{$month2}}>
                                        فبراير
                                    </option>
                                    <option value="3" {{$month3}}>
                                        مارس
                                    </option>
                                    <option value="4" {{$month4}}>
                                        ابريل
                                    </option>
                                    <option value="5" {{$month5}}>
                                        مايو
                                    </option>
                                    <option value="6" {{$month6}}>
                                        يونيو
                                    </option>
                                    <option value="7" {{$month7}}>
                                        يوليو
                                    </option>
                                    <option value="8" {{$month8}}>
                                        أغسطس
                                    </option>
                                    <option value="9" {{$month9}}>
                                        سبتمبر
                                    </option>
                                    <option value="10" {{$month10}}>
                                        أكتوبر
                                    </option>
                                    <option value="11" {{$month11}}>
                                        نوفمبر
                                    </option>
                                    <option value="12" {{$month12}}>
                                        ديسمبر
                                    </option>
                                </select>
                            </div>
                            <div id="cust_name" class="form-group">
                                <label>نوع الخطة</label>
                                <select id="plan_type"  name="plan_type_id" class="custom-select rounded-0">
                                    <option value="-1">اختر نوع الخطة</option>
                                    @foreach ($plan_types as $row)
                                        <option value="{{$row->id}}"
                                            @if ($row->id == $plan->type_id)
                                                {{'selected'}}
                                            @endif
                                            >
                                            {{$row->plan_type_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>تأريخ الخطة</label>
                                <input value="{{$plan->plan_date}}" type="date" class="form-control" name="plan_date">
                                @if ($errors->has('plan_date'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('plan_date') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    تعديل <i class="fas fa-edit"></i>
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