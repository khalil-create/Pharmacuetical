@extends('layouts.index')
@section('title')
    ادارة الاصناف
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاصناف</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/supervisor/manageItem">ادارة الاصناف</a></li>
                        <li class="breadcrumb-item active">تفاصيل الاصناف</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> تفاصيل الصنف:  
                        <span class="text-bold"> {{ $item->commercial_name }}</span>
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
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الاسم التجاري</span>
                                    <span class="info-box-number">{{$item->commercial_name}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الاسم العلمي</span>
                                    <span class="info-box-number">{{$item->science_name}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">السعر</span>
                                    <span class="info-box-number">{{$item->price}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">البونص</span>
                                    <span class="info-box-number">{{$item->bonus}}%</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-2">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">الوحدة</span>
                                    <span class="info-box-number">{{$item->unit}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        @if($item->category)
                            <div class="col-12 col-sm-6 col-md-2">
                                <div class="info-box mb-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text">مجموعة الصنف</span>
                                        <span class="info-box-number">
                                            <a href="/supervisor/showCategoryDetails/{{$item->category_id}}" title="تفاصيل">
                                                {{$item->category->name_cat}}
                                            </a>
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        @else
                            <div class="col-12 col-sm-6 col-md-4">
                                <div class="info-box mb-3">
                                    <div class="info-box-content">
                                        <span class="info-box-text">تمتلكله الشركات التالية:-</span>
                                        <span class="info-box-number">
                                            @foreach ($item->companies as $comp)
                                            <a href="/supervisor/showCompanyDetails/{{$comp->id}}" title="تفاصيل">
                                                - {{$comp->name_company}}
                                            </a>
                                            @endforeach
                                        </span>
                                    </div><!-- /.info-box-content -->
                                </div><!-- /.info-box -->
                            </div><!-- /.col -->
                        @endif
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$item->created_at) @endphp
                                    <span class="info-box-text">تأريخ اضافة هذا الصنف</span>
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
                    <span class="card-title" style="float: right"> استخدامات والتخصصات المستهدفة للصنف:  
                        <span class="text-bold">{{$item->commercial_name}}</span>
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
                                            <span class="info-box-text">الاستخدامات</span>
                                            <span class="info-box-number">
                                                {{$item->uses->count()}}
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
                                            <span class="info-box-text">التخصصات</span>
                                            <span class="info-box-number">{{$item->specialists->count()}}</span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- uses -->
                                @if($item->uses->count() > 0)
                                    @foreach ($item->uses as $row)
<<<<<<< HEAD
                                        {{-- <a href="/supervisor/showUseDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px"> --}}
                                        <a class="btn btn-block btn-default btn-lg col-md-12"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
=======
                                        <a href="/supervisor/showUseDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:1px -8px 38px 5px">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                                                <h6 style="float:right">{{$row->use}}</h6>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- specialists -->
                                @if($item->specialists->count() > 0)
                                    <div class="row">
                                        @foreach ($item->specialists as $row)
                                            {{-- <a href="/supervisor/showSpecialistDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px"> --}}
                                            <a class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                                <div class="col-12" style="margin:12px -8px 38px 5px">
                                                    <h6 style="float:right">{{$row->name}}</h6>
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