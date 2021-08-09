@extends('layouts.index')
@section('title')
    ادارة الخطط
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الخطط</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الخطط</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title" style="float: right">تعديل بيانات الخطة</h3>
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
          @if (session('status'))
              <div class="alert alert-success notify-success">
                  {{ session('status') }}
              </div>
          @endif
          @if (session('error'))
              <div class="alert alert-danger notify-error">
                  {{ session('error') }}
              </div>
          @endif
          <div class="form-group">
            <form method="POST" action="/supervisor/updatePlanCustomer/{{$planCust->id}}" onsubmit="return checkDataPlan()" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card-body">
              <div class="form-group">
                <div class="khalil">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">تعديل خطة</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">تأريخ الزيارة</label>
                                <input value="{{$planCust->visit_date}}" type="date" class="form-control" name="date" id="month_entered">
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('date') }}</small>
                                    </span>
                                @endif
                            </div>
                            <input type="hidden" id="month_plan" value="{{$planCust->plan->plan_month}}">
                            <div class="form-group">
                              <label for="date">العميل</label>
                              <select name="customer_name" class="form-control custom-select rounded-0">
                                  @foreach($customers as $row)
                                    <option value="{{$row->name}}" @if($planCust->customer_id == $row->id) {{'selected'}} @endif>
                                      {{$row->name}}
                                    </option>
                                  @endforeach
                                  @foreach($doctors as $row)
                                    <option value="{{$row->name}}" @if($planCust->doctor_id == $row->id) {{'selected'}} @endif>
                                      {{'د. '.$row->name}}
                                    </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              @php
                                  $AM = '';$PM = '';
                                  if($planCust->period == 'AM') $AM = 'selected';
                                  else $PM = 'selected';
                              @endphp
                              <label for="date">الفترة</label>
                              <select name="period" class="form-control custom-select rounded-0">
                                  <option value="AM" {{$AM}}>صباحية</option>
                                  <option value="PM" {{$PM}}>مسائية</option>
                              </select>
                            </div>
                            <div class="cform-group">
                              <label for="date">ملاحظه</label>
                                <textarea name="note" id="form" rows="1" class="form-control">{{$planCust->note}}</textarea>
                                <small id="invalidOwnerNo" class="form-text text-danger"></small>
                                @if ($errors->has('owner_tel'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('owner_tel') }}</small>
                                    </span>
                                @endif
                          </div>
                        </div>
                        {{-- <div class="col-md-12"> --}}
                          <div class="form-group" >
                            <button type="submit" class="btn btn-primary font" style="margin: 10px 15px -19px;">
                                تعديل <i class="fas fa-edit"></i>
                            </button>
                          </div>
                        {{-- </div> --}}
                      </div>
                    <!-- /.card-body -->
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
