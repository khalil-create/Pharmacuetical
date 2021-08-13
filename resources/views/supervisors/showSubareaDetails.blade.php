@extends('layouts.index')
@section('title')
    ادارة المناطق
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المناطق</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">تفاصيل المنطقة الفرعية</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> معلومات المنطقة الفرعية:  
                        <span class="text-bold"> {{ $subarea->name_sub_area }}</span>
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
                                    <span class="info-box-text">اسم المنطقة</span>
                                    <span class="info-box-number">{{$subarea->name_sub_area}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">منطقتها الرئيسية</span>
                                    <span class="info-box-number">
                                        {{$subarea->mainarea->name_main_area}}
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$subarea->created_at) @endphp
                                    <span class="info-box-text">تأريخ تسجيلها</span>
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
                    <span class="card-title" style="float: right"> المندوبيين العلميين للمنطقة الفرعية:  
                        <span class="text-bold">{{$subarea->name_sub_area}}</span>
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
                                                {{$subarea->representatives->whereNotNull('supervisor_id')->count()}}
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                {{-- </a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">
                                    <nav class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1" style="width:100%">
                                            <i class="fas fa-inbox"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">المناطق الفرعية</span>
                                            <span class="info-box-number">{{$subarea->subareas->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a> --}}
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- representatives -->
                                @if($subarea->representatives->whereNotNull('supervisor_id')->count() > 0)
                                    @foreach ($subarea->representatives->whereNotNull('supervisor_id') as $row)
                                        <a href="/supervisor/showRepDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:1px -8px 38px 5px">
                                                <div class="col-md-12" style="float:right">
                                                    {{$row->user->user_name_third}} {{$row->user->user_surname}}
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذه المنطقة الفرعية مندوبيين علميين' }}
                                    </div>
                                @endif
                            </div>
                            {{-- <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- subareas -->
                                @if($subarea->subareas->count() > 0)
                                    <div class="row">
                                        @foreach ($subarea->subareas as $row)
                                            <a href="/supervisor/showOrderDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                                <div class="col-12" style="margin:12px -8px 38px 5px">
                                                    <div class="col-md-12">
                                                        <h6 style="float:right">{{$row->name_sub_area}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذه المنطقة الرئيسية مناطق فرعية' }}
                                    </div>
                                @endif
                            </div> --}}
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection