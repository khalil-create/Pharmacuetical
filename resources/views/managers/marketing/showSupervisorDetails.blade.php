@extends('layouts.index')
@section('title')
    ادارة المشرفين
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المشرفين</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/managerMarketing/manageSupervisors">ادارة المشرفين</a></li>
                        <li class="breadcrumb-item active">تفاصيل المشرف</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> المعلومات الشخصية للمشرف:  
                        <span class="text-bold"> {{ $supervisor->user->user_name_third }} {{ $supervisor->user->user_surname }}</span>
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
                                    <span class="info-box-text">اسم المشرف</span>
                                    <span class="info-box-number">
                                        {{$supervisor->user->user_name_third}} {{$supervisor->user->user_surname}}
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الجنس</span>
                                    <span class="info-box-number">{{$supervisor->user->sex}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-5">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">مكان الميلاد(محافظة-مديرية-عزلة)</span>
                                    <span class="info-box-number">{{$supervisor->user->birthplace}} - {{$supervisor->user->town}} - {{$supervisor->user->village}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">تأريخ الميلاد</span>
                                    <span class="info-box-number">{{$supervisor->user->birthdate}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم الهاتف</span>
                                    <span class="info-box-number">{{$supervisor->user->phone_number}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">البريد الالكتروني</span>
                                    <span class="info-box-number">{{$supervisor->user->email}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">نوع الهوية</span>
                                    <span class="info-box-number">{{$supervisor->user->identity_type}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم الهوية</span>
                                    <span class="info-box-number">{{$supervisor->user->identity_number}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">مناطق الاشراف ( {{$supervisor->mainareas->count()}} مناطق رئيسية )</span>
                                    <span class="info-box-number">
                                        @if($supervisor->mainareas->count() > 0)
                                            @foreach ($supervisor->mainareas as $row)
                                            <a href="/managerMarketing/showMainareaDetails/{{$row->id}}" title="تفاصيل">
<<<<<<< HEAD
                                                - {{$row->name_main_area}}
=======
                                                {{$row->name_main_area}} - 
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                            </a>
                                            @endforeach
                                        @else
                                            <span class="text-danger">{{'لاتوجد'}}</span>
                                        @endif
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$supervisor->user->created_at) @endphp
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
                    <span class="card-title" style="float: right"> المندوبين العلميين والعملاء الشركات التابعه للمشرف:  
                        <span class="text-bold"> {{ $supervisor->user->user_name_third }} {{ $supervisor->user->user_surname }}</span>
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
                                            <span class="info-box-text">المندوبين</span>
                                            <span class="info-box-number">
                                                {{$supervisor->representatives->count()}}
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
                                            <span class="info-box-text">العملاء</span>
                                            <span class="info-box-number">{{$supervisor->doctors->where('statues',true)->count() + $customers->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"  style="width:90%">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">الشركات</span>
                                            <span class="info-box-number">{{$supervisor->companies->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- Customers -->
                                @if($supervisor->representatives->count() > 0)
                                    @foreach ($supervisor->representatives as $row)
                                        <a href="/managerMarketing/showRepresentativeDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
                                                {{-- <div class="col-md-12"> --}}
                                                    <h6 style="float:right">{{$row->user->user_name_third}} {{$row->user->user_surname}}</h6>
                                                {{-- </div> --}}
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- Doctors -->
                                <div class="col-md-6">
                                    <div class="khalil">
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">الاطباء ( {{$supervisor->doctors->where('statues',true)->count()}} )</h3>
                                        </div>
                                        <div class="card-body">
                                            @if($supervisor->doctors->where('statues',true)->count() > 0)
                                                @foreach ($supervisor->doctors->where('statues',true) as $row)
                                                    <a href="/managerMarketing/showDoctorDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-5"  style="height: 70px;margin:5px">
                                                        <div class="col-12" style="margin:12px -8px 38px 5px">
                                                            <h6 style="float:right">{{$row->name}}</h6>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div><!-- /.card-body -->
                                    </div><!-- /.khalil -->
                                </div><!-- /.col-md-6 -->
                                <div class="col-md-6">
                                    <div class="khalil">
                                        <div class="card-header">
                                            <h3 class="card-title" style="float: right">العملاء ( {{$customers->where('statues',true)->count()}} )</h3>
                                        </div>
                                        <div class="card-body">
                                            @if($customers->where('statues',true)->count() > 0)
                                                @foreach ($customers->where('statues',true) as $row)
                                                    <a href="/managerMarketing/showCustomerDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-5"  style="height: 70px;margin:5px">
                                                        <div class="col-12" style="margin:12px -8px 38px 5px">
                                                            <h6 style="float:right">{{$row->name}}</h6>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div><!-- /.card-body -->
                                    </div><!-- /.khalil -->
                                </div><!-- /.col-md-6 -->
                            </div>
                            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"><!-- companies -->
                                @if($supervisor->companies->count() > 0)
                                    @foreach ($supervisor->companies as $row)
                                        <a href="/managerMarketing/showCompanyDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
                                                <div class="col-md-12">
                                                    <h6 style="float:right">{{$row->name_company}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
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
@section('scripts')

@endsection