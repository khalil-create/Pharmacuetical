@extends('layouts.index')
@section('title')
    ادارة الدراسات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الدراسات العلمية</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">تفاصيل الدراسة العلمية</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right">معلومات الدراسة العلمية :- 
                        <span class="text-bold">{{$study->title}}</span>
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
                                    <span class="info-box-text">عنوان الدراسة</span>
                                    <span class="info-box-number">{{$study->title}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                                <div class="info-box-content">
                                    <span class="info-box-text">الجهة المُحكَمة</span>
                                    <span class="info-box-number">{{$study->source}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">سنةالاصدار</span>
                                    <span class="info-box-number">{{$study->emission_date}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$study->created_at) @endphp
                                    <span class="info-box-text">تأريخ اضافة الدراسة</span>
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
                    <span class="card-title" style="float: right"> نقاط القوة للدراسة العلمية :- 
                        <span class="text-bold">{{$study->title}}</span>
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
                                            <span class="info-box-text">نقاط القوة</span>
                                            <span class="info-box-number">
                                                {{$study->strengths->count()}}
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- strengths -->
                                @if($study->strengths->count() > 0)
                                    <div class="row">
                                        @foreach ($study->strengths as $row)
                                            <a class="btn btn-block btn-default btn-lg col-md-12"  style="height: 70px;margin:10px">
                                                {{-- <div class="col-12"> --}}
                                                    <div class="col-md-12" style="margin:15px -8px 15px">
                                                        <h6 style="float:right;">{{$row->strength}}</h6><br>
                                                    </div>
                                                {{-- </div> --}}
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذه الخدمة عملاء' }}
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