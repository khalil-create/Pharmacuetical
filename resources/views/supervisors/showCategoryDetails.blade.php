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
                        <li class="breadcrumb-item"><a href="/supervisor/manageCategory">ادارة مجموعات الاصناف</a></li>
                        <li class="breadcrumb-item active">تفاصيل مجموعة الاصناف</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title" style="float: right"> تفاصيل مجموعة الصنف:  
                        <span class="text-bold"> {{ $category->name_cat }}</span>
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
                        {{-- <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">المشرفين عليها</span>
                                    <span class="info-box-number">
                                        @php $supID_collect = collect(); $found = false; @endphp
                                        @foreach ($category->companies as $comp)
                                            @foreach ($supID_collect as $supId)
                                                @if($supId == $comp->supervisor->id)
                                                    @php $found = true; @endphp
                                                    @break;
                                                @endif
                                            @endforeach
                                            @if(!$found)
                                                <p>{{$comp->supervisor->user->user_name_third}} {{$comp->supervisor->user->user_surname}}</p>
                                                @php $supID_collect->push($comp->supervisor->id); @endphp
                                            @endif
                                        @endforeach
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col --> --}}
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    <span class="info-box-text">شركات تمتلكها</span>
                                    <span class="info-box-number">
                                        @foreach ($category->companies as $comp)
                                            <p>{{$comp->name_company}}</p>
                                        @endforeach
                                    </span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                                <div class="info-box-content">
                                    @php $date = explode(' ',$category->created_at) @endphp
                                    <span class="info-box-text">تأريخ اضافة هذه المجموعة</span>
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
                    <span class="card-title" style="float: right"> اصناف المجموعة:  
                        <span class="text-bold">{{$category->name_cat}}</span>
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
                                            <span class="info-box-text">الاصناف</span>
                                            <span class="info-box-number">
                                                {{$category->items->count()}}
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"><!-- categories -->
                                @if($category->items->count() > 0)
                                    @foreach ($category->items as $row)
                                        <a href="/supervisor/showItemDetails/{{$row->id}}" title="تفاصيل" class="btn btn-block btn-default btn-lg col-md-2"  style="height: 70px;margin:10px">
                                            {{-- <div class="col-12" style="margin:12px -8px 38px 5px"> --}}
                                                <div class="col-md-12" style="float:right;margin:15px -8px 15px">
                                                    <h6 style="float:right">{{$row->commercial_name}}</h6>
                                                </div>
                                            {{-- </div> --}}
                                        </a>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger notify-error">
                                        {{ 'لم يتم اضافة اي صنف لهذه المجموعة' }}
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