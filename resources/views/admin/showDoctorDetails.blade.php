@extends('layouts.index')
@section('title')
    ادارة الاطباء
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاطباء</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/manageDoctors">ادارة الاطباء</a></li>
                        <li class="breadcrumb-item active">تفاصيل الاطباء</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> المعلومات الشخصية للطبيب:  
                        <span class="text-bold"> {{ $doctor->name }}</span>
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
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">اسم الطبيب</span>
                                    <span class="info-box-number">{{$doctor->name}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم الهاتف المحمول</span>
                                    <span class="info-box-number">{{$doctor->mobile_phone}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم الهاتف الثابت للعيادة</span>
                                    <span class="info-box-number">{{$doctor->clinic_phone}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">مكان العمل (AM)</span>
                                    <span class="info-box-number">{{$doctor->workplace_am}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">مكان العمل (PM)</span>
                                    <span class="info-box-number">{{$doctor->workplace_pm}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الولاء للمؤسسة</span>
                                    <span class="info-box-number">
                                        @if ($doctor->loyalty == 1)
                                            {{'A+'}}
                                        @elseif($doctor->loyalty == 2)
                                            {{'A'}}
                                        @elseif($doctor->loyalty == 3)
                                            {{'B+'}}
                                        @elseif($doctor->loyalty == 4)
                                            {{'B'}}
                                        @elseif($doctor->loyalty == 5)
                                            {{'C'}}
                                        @elseif($doctor->loyalty == 6)
                                            {{'Z'}}
                                        @endif
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الرتبة</span>
                                    <span class="info-box-number">
                                        @if ($doctor->rank == 1)
                                            {{'A+'}}
                                        @elseif($doctor->rank == 2)
                                            {{'A'}}
                                        @elseif($doctor->rank == 3)
                                            {{'B+'}}
                                        @elseif($doctor->rank == 4)
                                            {{'B'}}
                                        @elseif($doctor->rank == 5)
                                            {{'C'}}
                                        @elseif($doctor->rank == 6)
                                            {{'Z'}}
                                        @endif
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">العنوان</span>
                                    <span class="info-box-number">{{$doctor->address}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الحالة</span>
                                    <span class="info-box-number">
                                        @if ($doctor->statues)
                                            <a href="/admin/notActivateDoctor/{{$doctor->id}}" title="إلغاء التفعيل"><span class="info-box-number text-success">{{'مفعل'}}</span></a>
                                        @else
                                            <a href="/admin/activateDoctor/{{$doctor->id}}" title="تفعيل"><span class="info-box-number text-danger">{{'غير مفعل'}}</span></a>
                                        @endif
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">يتبع المندوب</span>
                                    <span class="info-box-number">
                                        <a href="/admin/showUserDetails/{{$doctor->representative->user_id}}" title="تفاصيل">
                                            {{$doctor->representative->user->user_name_third}} {{$doctor->representative->user->user_surname}}
                                        </a>
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$doctor->created_at) @endphp
                                    <span class="info-box-text">تأريخ الانضمام</span>
                                    <span class="info-box-number">{{$date[0]}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> خدمات وتخصصات الطبيب:  
                        <span class="text-bold">{{$doctor->name}}</span>
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
                                            <span class="info-box-text">الخدمات</span>
                                            <span class="info-box-number">
                                                {{$doctor->services->count()}}
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">
                                    <nav class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1" style="width:100%">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">التخصصات</span>
                                            <span class="info-box-number">{{$doctor->specialists->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- Customers -->
                                @if($doctor->services->count() > 0)
                                    @foreach ($doctor->services as $row)
                                        {{-- <a href="/admin/showServiceDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px"> --}}
                                        <a class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-md-12 align-right" style="margin:15px -8px 15px">
                                                <small>
                                                    @if ($row->type)
                                                        {{'خدمة مادية '}}
                                                    @else
                                                        {{'خدمة عينية '}}
                                                    @endif
                                                    {{$row->name}} {{' تكلفتها '.$row->cost}}
                                                </small>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- Doctors -->
                                @if($doctor->specialists->count() > 0)
                                    <div class="row">
                                        @foreach ($doctor->specialists as $row)
                                            {{-- <a href="/admin/showSpecialistDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px"> --}}
                                            <a class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                                <div class="col-md-12 align-right" style="margin:15px -8px 15px">
                                                    <h6>{{$row->name}}</h6>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection