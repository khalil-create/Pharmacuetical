@extends('layouts.index')
@section('title')
    ادارة الشركات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الشركات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                        <li class="breadcrumb-item active">تفاصيل الشركة</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> تفاصيل الشركة:  
                        <span class="text-bold"> {{ $company->name_company }}</span>
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
                        <div class="col-sm-3">
                            <img class="img-fluid" src="{{asset('images/signsCompany/'.$company->sign_img_company)}}">
                        </div><!-- /.col -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">بلد التصنيع</span>
                                    <span class="info-box-number">{{$company->country_manufacturing}}</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-5">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">المشرف عليها</span>
                                    <span class="info-box-number">
                                        {{$company->supervisor->user->user_name_third}} {{$company->supervisor->user->user_surname}}
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$company->created_at) @endphp
                                    <span class="info-box-text">تأريخ اضافة الشركة</span>
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
                    <span class="card-title" style="float: right"> فئات واصناف الشركة:  
                        <span class="text-bold">{{$company->company_name}}</span>
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
                                            <span class="info-box-text">الفئات</span>
                                            <span class="info-box-number">
                                                {{$company->categories->count()}}
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
                                            <span class="info-box-text">الاصناف</span>
                                            <span class="info-box-number" id="count_items">
                                                @if (!$company->have_category)
                                                    {{$company->items->count()}}
                                                @endif
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </nav><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- categories -->
                                @if($company->categories->count() > 0)
                                    @foreach ($company->categories as $row)
                                        <a href="/supervisor/showCategoryDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-2"  style="height: 70px;margin:10px">
                                            <div class="col-12" style="margin:12px -8px 38px 5px">
                                                <div class="col-md-12">
                                                    <h6 style="float:right">{{$row->name_cat}}</h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لايوجد لدى هذه الشركة فئات' }}
                                    </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"><!-- items -->
                                <div class="row">@php $found = false;$count_items = 0; @endphp
                                    @if($company->have_category)
                                        @foreach ($company->categories as $cat)
                                            @if($cat->items->count() > 0)  
                                                @php $found = true;$count_items+=$cat->items->count(); @endphp
                                            @endif
                                            @foreach ($cat->items as $item)
                                                <a href="/supervisor/showItemDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-2"  style="height: 70px;margin:10px">
                                                    <div class="col-12" style="margin:12px -8px 38px 5px">
                                                        <div class="col-md-12">
                                                            <h6 style="float:right">{{$item->commercial_name}}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @endforeach
                                        @if(!$found)
                                            <div class="alert alert-danger notify-error">
                                                {{ 'لايوجد لدى هذه الشركة اصناف' }}
                                            </div>
                                        @endif
                                    @else
                                        @if($company->items->count() > 0)
                                            @foreach ($company->items as $item)
                                                <a href="/supervisor/showItemDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-3"  style="height: 70px;margin:10px">
                                                    <div class="col-12" style="margin:12px -8px 38px 5px">
                                                        <div class="col-md-12">
                                                            <h6 style="float:right">{{$item->commercial_name}}</h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="alert alert-danger notify-error">
                                                {{ 'لايوجد لدى هذه الشركة اصناف' }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <input type="text" id="counter_items" value="{{$count_items}}" hidden>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
</div>
@endsection