@extends('layouts.index')
@section('title')
    ادارة الخدمات
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الخدمات</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">الخدمات</li>
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
                <h3 class="card-title" style="float: right">تعديل خدمة</h3>
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
                    @if (session('error'))
                        <div class="alert alert-danger notify-error">
                            {{ session('error') }}
                        </div>
                    @endif
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <form method="POST" action="/repScience/updateService/{{$service->id}}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                @php
                                    $money = '';
                                    $physical = '';
                                    if($service->type == 1) $physical = 'selected';
                                    else $money = 'selected';
                                @endphp
                                <label>نوع الخدمة</label>
                                <select onchange="showServiceName()" id="service_type" name="type" class="custom-select rounded-0">
                                    <option value="0" {{$money}}>
                                        عيني
                                    </option>
                                    <option value="1" {{$physical}}>
                                        مادي
                                    </option>
                                </select>
                            </div>
                            @php
                                $i = 0;
                            @endphp
                            <div id="service_name" class="form-group" @if($service->type == 0 || $i != 0) {{ 'hidden' }} $i++; @endif>
                                <label>اسم الخدمة</label>
                                <input value="{{$service->name}}" type="text" name="name" class="form-control">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                    </span>
                                @endif
                            </div>
                            {{-- <script>
                                service_name = document.getElementById("service_name");
                                if(service_name.value == 0){
                                    service_name.hidden = true;
                                    s_name.value = 'write service name';
                                }
                            </script> --}}
                            <div class="form-group">
                                <label>تكلفة الخدمة</label>
                                <input value="{{$service->cost}}" type="text" name="cost" class="form-control">
                                @if ($errors->has('cost'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('cost') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>نوع العميل</label>
                                <select onchange="showCustType()" id="cust_type" name="cust_type" class="custom-select rounded-0">
                                    <option value="-1">
                                        اختر نوع العميل
                                    </option>
                                    @if($customers->count() > 0)
                                        <option value="0">
                                            عميل (صيدلية-مستشفى)
                                        </option>
                                    @endif
                                    @if($doctors->count() > 0)
                                        <option value="1">
                                            دكتور
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <div id="cust_name" class="form-group" hidden>
                                <label>اسم العميل <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من عميل)</span></label>
                                <select  name="cust_ids[]" class="custom-select rounded-0" multiple>
                                    @foreach ($customers as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="doctor_name" class="form-group" hidden>
                                <label>اسم الدكتور <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من دكتور)</span></label>
                                <select name="doctor_ids[]" class="custom-select rounded-0" multiple>
                                    @foreach ($doctors as $row)
                                        <option value="{{$row->id}}">
                                            {{$row->name}}
                                        </option>
                                    @endforeach
                                </select>
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