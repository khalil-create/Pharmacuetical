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
                <h3 class="card-title" style="float: right">إضافة طلبية</h3>
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
                        <form id="form" method="POST" action="/supervisor/storeOrder"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>العميل</label>
                                <select  name="customer_id" class="custom-select rounded-0">
                                    @foreach ($supervisor->customers as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">اسم المندوب</label>
                                    <select name="rep_id" class="form-control custom-select rounded-0">
                                        @foreach ($supervisor->representatives as $rep)
                                            <option value="{{$rep->id}}">{{$rep->user->user_name_third}} {{$rep->user->user_surname}}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>الصنف</label>
                                <select  name="item_id" class="custom-select rounded-0">
                                    @foreach ($supervisor->company as $comp)
                                        @if ($comp->have_category == 1)
                                            @foreach ($comp->categories as $cat)
                                                @foreach ($cat->items as $item)
                                                    <option value="{{$item->id}}">{{$item->commercial_name}}</option>
                                                @endforeach
                                            @endforeach
                                        @else
                                            @foreach ($comp->items as $item)
                                                <option value="{{$item->id}}">{{$item->commercial_name}}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>الكمية</label>
                                <input type="text" name="count" class="form-control">
                                @if ($errors->has('count'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('count') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>البونص</label>
                                <input type="text" name="bonus" class="form-control">
                                @if ($errors->has('bonus'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>ملاحظة</label>
                                {{-- <input type="text" name="note"  class="form-control"> --}}
                                <textarea name="note" id="form" cols="30" rows="4" class="form-control"></textarea>
                                @if ($errors->has('note'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('note') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    حفظ<i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                        <!-- /.form-group -->
                    </form>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                the plugin.
                </div>
            </div>
            <!-- /.card -->
            </div>
        <!-- /.container-fluid -->
    </section>
</div>
</div>
@endsection
@section('scripts')
    
@endsection