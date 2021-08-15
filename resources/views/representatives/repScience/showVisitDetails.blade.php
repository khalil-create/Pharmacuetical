@extends('layouts.index')
@section('title')
    ادارة الزيارات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الزيارات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">تفاصيل الزيارة</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> معلومات الزيارة
                        <span class="text-bold"></span>
                    </span>
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
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">نوع الزيارة</span>
                                    <span class="info-box-number">
                                        @if ($visit->type == 1)
                                            {{'مصحوبة مع المشرف/علمية'}}
                                        @elseif($visit->type == 2)
                                            {{'عرض خدمة'}}
                                        @else
                                            {{'حل مشكلة'}}
                                        @endif
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">فترة الزيارة</span>
                                    <span class="info-box-number">
                                        @if ($visit->period == 1)
                                            {{'AM'}}
                                        @elseif($visit->period == 2)
                                            {{'PM'}}
                                        @endif
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">تأريخ الزيارة</span>
                                    <span class="info-box-number">{{$visit->date}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">العميل</span>
                                    <span class="info-box-number">
                                        @if ($visit->doctor)
                                            {{'د. '.$visit->doctor->name}}
                                        @else
                                            {{$visit->customer->name}}
                                        @endif
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        @if ($visit->type == 1)
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text">الصنف المستهدف</span>
                                        <span class="info-box-number">{{$visit->composition->item}}</span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text">الرسالة العلمية الموجهة</span>
                                        <span class="info-box-number">{{$visit->composition->scientific_mission}}</span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        @elseif($visit->type == 2)
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text">الخدمة التي تم عرضها</span>
                                        <span class="info-box-number">
                                            @if($visit->serviceOffer->services->type)
                                                {{'خدمة مادية:- '}}{{$visit->serviceOffer->services->name}}
                                            @else
                                                {{'خدمة عينية'}}
                                            @endif
                                            {{'تكلفتها بـ '}}{{$visit->serviceOffer->services->cost}}
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        @else
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text">وصف المشكلة</span>
                                        <span class="info-box-number">{{$visit->solveProblem->description}}</span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        @endif
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">نتيجة الزيارة</span>
                                    <span class="info-box-number">{{$visit->result}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">تتبع المندوب</span>
                                    <span class="info-box-number">
                                        {{$visit->representative->user->user_name_third}} {{$visit->representative->user->user_surname}}
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    {{-- <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> العملاء والاطباء الذين طلبوا الخدمة
                        <span class="text-bold">{{$visit->name}}</span>
                    </span>
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
                    <!-- Info boxes -->
                    <div class="row mt-1">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1" style="width:100%">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">العملاء</span>
                                            <span class="info-box-number">
                                                {{$visit->visitCustomers->count()}}
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">
                                    <nav class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1" style="width:100%">
                                            <i class="fas fa-inbox"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">الاطباء</span>
                                            <span class="info-box-number">{{$visit->visitDoctors->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- representatives -->
                                @if($visit->visitCustomers->count() > 0)
                                    @foreach ($visit->customers as $row)
                                        <a href="/supervisor/showCustomerDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12">
                                                <div class="col-md-12" style="margin:10px 0px -8px 5px;float:right">
                                                    <h6 style="float:right">{{$row->name}}</h6>
                                                    <small class="text-sm text-bold floatt">
                                                        @if($row->statues)
                                                            <span>{{'مقبوله'}} <i class="fas fa-check"></i></span>
                                                        @else
                                                            <span class="text-danger">{{'غير مقبوله'}}</span>
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذه الخدمة عملاء' }}
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- visits -->
                                @if($visit->visitDoctors->count() > 0)
                                    <div class="row">
                                        @foreach ($visit->doctors as $row)
                                            <a href="/supervisor/showOrderDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                                <div class="col-12">
                                                    <div class="col-md-12" style="margin:10px 0px -8px 5px;float:right">
                                                        <h6 style="float:right">{{$row->name}}</h6>
                                                        <small class="text-sm text-bold floatt">
                                                            @if($row->statues)
                                                                <span>{{'مقبوله'}} <i class="fas fa-check"></i></span>
                                                            @else
                                                                <span class="text-danger">{{'غير مقبوله'}}</span>
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذه الخدمة اطباء' }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section> --}}
</div>
@endsection