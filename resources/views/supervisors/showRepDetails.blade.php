@extends('layouts.index')
@section('title')
    ادارة المندوبين العلميين
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المندوبين العلميين</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">تفاصيل المندوب العلمي</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> المعلومات الشخصية للمندوبـ/ ـة:  
                        <span class="text-bold"> {{ $rep->user->user_name_third }} {{ $rep->user->user_surname }}</span>
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
                                {{-- <span class="info-box-icon elevation-1">
                                    <img src="{{asset('images/users/'.$rep->user->user_image)}}" class="img-circle elevation-2" alt="User Image">
                                </span> --}}
                                <div class="info-box-content">
                                    <span class="info-box-text">اسم المندوب العلمي
                                        @if($rep->teamleader_id == null)
                                            <small>({{$rep->user->user_type}})</small>
                                        @endif
                                    </span>
                                    <span class="info-box-number">
                                        {{$rep->user->user_name_third}} {{$rep->user->user_surname}}
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                {{-- <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span> --}}
                                <div class="info-box-content">
                                    <span class="info-box-text">الجنس</span>
                                    <span class="info-box-number">{{$rep->user->sex}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">مكان الميلاد(محافظة-مديرية-عزلة)</span>
                                    <span class="info-box-number">{{$rep->user->birthplace}} - {{$rep->user->town}} - {{$rep->user->village}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">تأريخ الميلاد</span>
                                    <span class="info-box-number">{{$rep->user->birthdate}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم الهاتف</span>
                                    <span class="info-box-number">{{$rep->user->phone_number}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">البريد الالكتروني</span>
                                    <span class="info-box-number">{{$rep->user->email}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">نوع الهوية</span>
                                    <span class="info-box-number">{{$rep->user->identity_type}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم الهوية</span>
                                    <span class="info-box-number">{{$rep->user->identity_number}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$rep->user->created_at) @endphp
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
                    <span class="card-title" style="float: right"> عملاء ومناطق المندوبـ/ ـة:  
                        <span class="text-bold"> {{ $rep->user->user_name_third }} {{ $rep->user->user_surname }}</span>
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
                                                {{$rep->customers->where('statues',true)->count()}}
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
                                            <span class="info-box-text">الاطباء</span>
                                            <span class="info-box-number">{{$rep->doctors->where('statues',true)->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                                <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"  style="width:90%">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">المناطق</span>
                                            <span class="info-box-number">{{$rep->subareas->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- Customers -->
                                @if($rep->customers->where('statues',true)->count() > 0)
                                    @foreach ($rep->customers->where('statues',true) as $row)
                                        <a href="/supervisor/showCustomerDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
                                                <div class="col-md-12">
                                                    <h6 style="float:right">{{$row->name}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذا المندوب عملاء' }}
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- Doctors -->
                                @if($rep->doctors->where('statues',true)->count() > 0)
                                    @foreach ($rep->doctors->where('statues',true) as $row)
                                        <a href="/supervisor/showDoctorDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
                                                <div class="col-md-12">
                                                    <h6 style="float:right">{{$row->name}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذا المندوب اطباء' }}
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"><!-- Subareas -->
                                @if($rep->subareas->count() > 0)
                                    @foreach ($rep->subareas as $row)
                                        <a href="/supervisor/showSubarearDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
                                                <div class="col-md-12">
                                                    <h6 style="float:right">{{$row->name_sub_area}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-success">
                                        {{ 'لايوجد لدى هذا المندوب مناطق فرعية' }}                    
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
@section('scripts')

@endsection