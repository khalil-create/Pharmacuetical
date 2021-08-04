@extends('layouts.index')
@section('title')
    ادارة الزيارات
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الزيارات</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">الزيارات</li>
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
                <h3 class="card-title" style="float: right">إضافة زيارة</h3>
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
                        <form method="POST" action="/repScience/storeVisit"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
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
                                <label>اسم العميل</label>
                                <select  name="customer_id" class="custom-select rounded-0">
                                    @foreach ($customers as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="doctor_name" class="form-group" hidden>
                                <label>اسم الدكتور</label>
                                <select name="doctor_id" class="custom-select rounded-0">
                                    @foreach ($doctors as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>نوع الزيارة</label>
                                <select onchange="checkVisitType()" id="visit_type" name="type" class="custom-select rounded-0">
                                    <option value="-1">
                                        اختر نوع الزيارة
                                    </option>
                                    <option value="1">
                                        مصاحبة مع المشرف او علمية
                                    </option>
                                    <option value="2">
                                        تقديم خدمة
                                    </option>
                                    <option value="3">
                                        حل مشكلة
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>الفترة</label>
                                <select id="period" name="period" class="custom-select rounded-0">
                                    <option value="1">
                                        صباحية
                                    </option>
                                    <option value="0">
                                        مسائية
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>تأريخ الزيارة</label>
                                <input type="date" class="form-control" name="date">
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('date') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div id="item" class="form-group" hidden>
                                <label>الصنف المستهدف</label>
                                <select name="item" class="custom-select rounded-0">
                                    @foreach ($rep->items as $item)
                                        <option value="{{$item->commercial_name}}">
                                            {{$item->commercial_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="scientific_mission" class="form-group" hidden>
                                <label>الرسالة العلمية الموجهة</label>
                                <input id="mission" name="scientific_mission" class="form-control">
                                @if ($errors->has('scientific_mission'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('scientific_mission') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div id="service_name" class="form-group" hidden>
                                <label>الخدمة</label>
                                <select name="service_id" class="custom-select rounded-0">
                                    @foreach ($rep->services as $serv)
                                        <option value="{{$serv->id}}">
                                            @if ($serv->type)
                                                {{'خدمة مادية('.$serv->name.') تكلفتها بـ'.$serv->cost}}
                                            @else
                                                {{'خدمة عينية تكلفتها بـ'.$serv->cost}}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="description" class="form-group" hidden>
                                <label>وصف المشكلة</label>
                                <textarea name="description" id="desc" cols="30" rows="4" class="form-control"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('description') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>نتيجة الزيارة</label>
                                <textarea name="result" cols="30" rows="4" class="form-control"></textarea>
                                @if ($errors->has('result'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('result') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    حفظ<i class="fas fa-plus"></i>
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