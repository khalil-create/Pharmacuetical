@extends('layouts.index')
@section('title')
    ادارة الطلبيات
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الطلبيات</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">الطلبيات</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

<!-- /.content-header -->
<div>
    <section class="content" >
            <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                <h3 class="card-title" style="float: right">تعديل طلبية</h3>
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
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <form id="form" method="POST" action="/managerSales/updateOrder/{{$order->id}}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div id="cust_name" class="form-group">
                                <label>العميل</label>
                                <select name="customer_id" class="custom-select rounded-0">
                                    @foreach ($customers as $row)
                                        <option value="{{$row->id}}"
                                            @if ($row->id == $order->customer_id)
                                                {{'selected'}}
                                            @endif>
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">اسم المندوب</label>
                                    <select name="rep_id" class="form-control custom-select rounded-0">
                                        @foreach ($reps as $rep)
                                            <option value="{{$rep->id}}"
                                                @if ($rep->id == $order->representative_id)
                                                    {{'selected'}}
                                                @endif
                                                >{{$rep->user->user_name_third}} {{$rep->user->user_surname}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div id="cust_name" class="form-group">
                                <label>الصنف</label>
                                <select  name="item_id" class="custom-select rounded-0">
                                    @foreach ($items as $item)
                                        <option value="{{$item->id}}"
                                            @if ($item->id == $order->item_id)
                                                {{'selected'}}
                                            @endif
                                            >{{$item->commercial_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>الكمية</label>
                                <input value="{{$order->count}}" type="text" name="count" class="form-control">
                                @if ($errors->has('count'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('count') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>البونص ( % )</label>
                                <input value="{{$order->bonus}}" type="text" name="bonus" class="form-control">
                                @if ($errors->has('bonus'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>ملاحظة</label>
                                {{-- <input type="text" name="note"  class="form-control"> --}}
                                <textarea name="note" id="form" cols="30" rows="4" class="form-control">{{$order->note}}</textarea>
                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('note') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    تعديل <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form><!-- /.form -->
            </div><!-- /.form-group -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.card-body -->
</div><!-- /.card -->
</div><!-- /.container-fluid -->
</section>
<div class="card-footer">
Footer
</div>
</div><!-- /.content-header -->
@endsection
@section('scripts')
    
@endsection