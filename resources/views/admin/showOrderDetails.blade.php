@extends('layouts.index')
@section('title')
    ادارة الطلبيات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ادارة الطلبيات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/manageOrders">ادارة الطلبيات</a></li>
                        <li class="breadcrumb-item active">تفاصيل الطلبيه</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> تفاصيل الطلبيه للعميل:  
                        <span class="text-bold"> {{ $order->customer->name }}</span>
                    </span>
                    <div class="card-tools float-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الصنف</span>
                                    <span class="info-box-number">{{$order->item->commercial_name}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الكمية</span>
                                    <span class="info-box-number">{{$order->count}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">السعر</span>
                                    <span class="info-box-number">{{$order->item->price}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">البونص ( % )</span>
                                    <span class="info-box-number">{{$order->item->bonus}}%</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">المبلغ الكلي</span>
                                    <span class="info-box-number">{{($order->item->price * ((100 - $order->item->bonus) / 100)) * $order->count}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$order->created_at) @endphp
                                    <span class="info-box-text">تأريخ طلب الطلبيه</span>
                                    <span class="info-box-number">{{$date[0]}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">ملاحظة</span>
                                    <span class="info-box-number">{{$order->note}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">تتبع المندوب</span>
                                    <span class="info-box-number">
                                        @foreach ($order->customer->representative as $rep)
                                            @if ($rep->user->user_type == 'مندوب علمي' || $rep->user->user_type == 'مدير فريق')
                                                <a href="/admin/showRepDetails/{{$rep->id}}" title="تفاصيل">
                                                    <p><span class="text-success">م.علمي: </span> {{$rep->user->user_name_third}} {{$rep->user->user_surname}}<p>
                                                </a>
                                            @else
                                                <a href="/admin/showSalesRepDetails/{{$rep->id}}" title="تفاصيل">
                                                    <p><span class="text-success">م.مبيعات: </span> {{$rep->user->user_name_third}} {{$rep->user->user_surname}}<p>
                                                </a>
                                            @endif
                                        @endforeach
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection