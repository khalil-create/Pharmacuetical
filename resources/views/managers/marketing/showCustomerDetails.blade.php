@extends('layouts.index')
@section('title')
    ادارة العملاء
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة العملاء</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/managerMarketing/manageCustomers">ادارة العملاء</a></li>
                        <li class="breadcrumb-item active">تفاصيل العملاء</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> المعلومات الشخصية للعميل:  
                        <span class="text-bold"> {{ $customer->name }}</span>
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
                                    <span class="info-box-text">اسم العميل</span>
                                    <span class="info-box-number">{{$customer->name}}</span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">اسم المالك</span>
                                    <span class="info-box-number">{{$customer->owner_name}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">رقم هاتف المالك</span>
                                    <span class="info-box-number">{{$customer->owner_phone}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="clearfix hidden-md-up"></div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">تلفون المالك الأرضي</span>
                                    <span class="info-box-number">{{$customer->owner_tel}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">حجم العميل</span>
                                    <span class="info-box-number">
                                        @if ($customer->size == 1)
                                            {{'A+'}}
                                        @elseif($customer->size == 2)
                                            {{'A'}}
                                        @elseif($customer->size == 3)
                                            {{'B+'}}
                                        @elseif($customer->size == 4)
                                            {{'B'}}
                                        @elseif($customer->size == 5)
                                            {{'C'}}
                                        @endif
                                    </span>
                                </div> <!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الولاء للمؤسسة</span>
                                    <span class="info-box-number">
                                        @if ($customer->loyalty == 1)
                                            {{'A+'}}
                                        @elseif($customer->loyalty == 2)
                                            {{'A'}}
                                        @elseif($customer->loyalty == 3)
                                            {{'B+'}}
                                        @elseif($customer->loyalty == 4)
                                            {{'B'}}
                                        @elseif($customer->loyalty == 5)
                                            {{'C'}}
                                        @elseif($customer->loyalty == 6)
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
                                    <span class="info-box-number">{{$customer->address}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الحالة</span>
                                    <span class="info-box-number">
                                        @if ($customer->statues)
<<<<<<< HEAD
                                            <a href="/managerMarketing/notActivateCustomer/{{$customer->id}}" title="إلغاء التفعيل"><span class="info-box-number text-success">{{'مفعل'}}</span></a>
                                        @else
                                            <a href="/managerMarketing/activateCustomer/{{$customer->id}}" title="تفعيل"><span class="info-box-number text-danger">{{'غير مفعل'}}</span></a>
=======
                                            <a href="/managerMarketing/notActivateDoctor/{{$customer->id}}" title="إلغاء التفعيل"><span class="info-box-number text-success">{{'مفعل'}}</span></a>
                                        @else
                                            <a href="/managerMarketing/activateDoctor/{{$customer->id}}" title="تفعيل"><span class="info-box-number text-danger">{{'غير مفعل'}}</span></a>
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                        @endif
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">اسم مسؤول الاتصال</span>
                                    <span class="info-box-number">{{$customer->contact_official_name}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span>الموقع الوظيفي لمسؤول الاتصال</span>
                                    <span class="info-box-number">{{$customer->contact_official_type}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="">رقم الهاتف المحمول لمسؤول الاتصال</span>
                                    <span class="info-box-number">{{$customer->contact_official_tel}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="">رقم الهاتف الأرضي لمسؤول الاتصال</span>
                                    <span class="info-box-number">{{$customer->contact_official_phone}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">يتبع المندوبين</span>
                                    <span class="info-box-number">
                                        @foreach ($customer->representative as $rep)
                                            @if ($rep->user->user_type == 'مندوب علمي' || $rep->user->user_type == 'مدير فريق')
                                                <a href="/managerMarketing/showRepDetails/{{$rep->id}}" title="تفاصيل">
                                                    <p><span class="text-success">م.علمي: </span> {{$rep->user->user_name_third}} {{$rep->user->user_surname}}<p>
                                                </a>
                                            @else
                                                <a href="/managerMarketing/showSalesRepDetails/{{$rep->id}}" title="تفاصيل">
                                                    <p><span class="text-success">م.مبيعات: </span> {{$rep->user->user_name_third}} {{$rep->user->user_surname}}<p>
                                                </a>
                                            @endif
                                        @endforeach
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$customer->created_at) @endphp
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
                    <span class="card-title" style="float: right"> خدمات وطلبيات العميل:  
                        <span class="text-bold">{{$customer->name}}</span>
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
                                                {{$customer->services->count()}}
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
                                            <span class="info-box-text">الطلبيات</span>
                                            <span class="info-box-number">{{$customer->orders->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- Services -->
                                @if($customer->services->count() > 0)
                                    @foreach ($customer->services as $row)
                                        <a href="/managerMarketing/showServiceDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-4"  style="height: 70px;margin:10px">
<<<<<<< HEAD
                                            <div class="col-md-12" style="margin:15px -8px 15px">
                                                <h6 class="align-right">
                                                    @if ($row->type)
                                                        {{'خدمة مادية '}}
                                                    @else
                                                        {{'خدمة عينية '}}
                                                    @endif
                                                    {{'( '.$row->name}} {{' تكلفتها '.$row->cost.' )'}}
                                                </h6>
                                            </div>
=======
                                            {{-- <div class="col-12"> --}}
                                                <div class="col-md-12" style="margin:15px -8px 15px">
                                                    <h6 class="align-right">
                                                        @if ($row->type)
                                                            {{'خدمة مادية '}}
                                                        @else
                                                            {{'خدمة عينية '}}
                                                        @endif
                                                        {{'( '.$row->name}} {{' تكلفتها '.$row->cost.' )'}}
                                                    </h6>
                                                </div>
                                            {{-- </div> --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- Orders -->
                                @if($customer->orders->count() > 0)
                                    <div class="row">
                                        @foreach ($customer->orders as $row)
                                            <a href="/managerMarketing/showOrderDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
<<<<<<< HEAD
                                                <div class="col-md-12" style="margin:15px -8px 15px">
                                                    <span sclass="align-right">{{$row->item->commercial_name}}   {{$row->count}}</span>
                                                </div>
=======
                                                {{-- <div class="col-12" style="margin:12px -8px 38px 5px"> --}}
                                                    <div class="col-md-12" style="margin:15px -8px 15px">
                                                        <span sclass="align-right">{{$row->item->commercial_name}}   {{$row->count}}</span>
                                                    </div>
                                                {{-- </div> --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
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