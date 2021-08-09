@php
    use App\Traits\userTrait;
    use Carbon\Carbon;
@endphp
@extends('layouts.index')
@section('title')
    ادارة الاشعارات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاشعارات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">جميع الاشعارات</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right">جميع الاشعارات</span>
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
                        @foreach (Auth::user()->unreadnotifications as $notify)
                            @php
                                $route = userTrait::getRouteReadNotification($notify->data['title']);
                                $since = userTrait::getSinceTimePast($notify->updated_at);
                            @endphp
                            <a href="{{route($route,['id' => $notify->id])}}" title="رؤية المزيد" class="btn btn-block btn-default btn-lg col-md-12">
                                <div class="col-12" style="margin-bottom: 2px">
                                    <div class="col-md-12">
                                        <h6 style="float:right;margin-bottom: 2px">{{$notify->data['content']}}</h6><br>
                                        <p class="text-sm text-bold text-muted" style="float: right;margin:-5px -8px 0px 0px"><i class="far fa-clock mr-2" style="margin-left: 10px"></i>{{ $since }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection