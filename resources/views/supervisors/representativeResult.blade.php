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
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
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
                        <a  title="درجة الاختبار" class="btn btn-block btn-default btn-lg col-md-2"  style="height: 70px;margin:10px">
                            <div class="col-12" style="margin:12px 30px 8px 5px">
                                <div class="col-md-12">
                                    <h6 style="float:right">{{$repResult->result}}</h6>
                                </div>
                            </div>
                        </a>
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection