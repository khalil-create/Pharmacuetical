@extends('layouts.index')
@section('title')
    ادارة الاختبارات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاختبارات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/repScience/manageTests">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">درجة الاختبار</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> درجة اختبار 
                        <span class="text-bold"> {{$repResult->test->test_name}} </span>
                        للمندوبـ/ـة: 
                        <span class="text-bold"> 
                            {{ $repResult->representative->user->user_name_third }} {{ $repResult->representative->user->user_surname }}
                        </span>
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
                        @php
                            $results = $repResult->result;
                            $results_arr = explode("+",$results);
                            $i = 0;
                        @endphp
                        @foreach ($results_arr as $result)
                            <div class="col-12 col-sm-6 col-md-2">
                                <div class="info-box mb-3">
                                    <div class="info-box-content @if($result >= 50) {{'alert-success'}} @else {{'alert-danger'}} @endif">
                                        <span class="info-box-text">درجة الاختبار رقم {{++$i}}</span>
                                        <span class="info-box-number">{{$result}}%</span>
                                    </div><!-- /.info-box-content -->
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 col-sm-6 col-md-2" style="height: 100%;width:100%">
                            <a href="/repScience/repTests/{{$repResult->test->id}}" title="تفاصيل" class="btn alert-success btn-lg col-12" style="height: 85px">
                                <div class="col-md-12 align-center" style="margin-top: 20px">
                                    <h6>اعادة الاختبار</h6>
                                </div>
                            </a>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection