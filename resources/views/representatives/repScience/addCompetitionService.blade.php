@extends('layouts.index')
@section('title')
    ادارة الخدمات المنافسه
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة الخدمات المنافسه</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">الخدمات المنافسه</li>
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
                <h3 class="card-title" style="float: right">إضافة خدمة منافسه</h3>
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
                                <form method="POST" action="/repScience/storeCompetitionService"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>الصنف المنافس</label>
                                                <input type="text" name="item_name" class="form-control">
                                                @if ($errors->has('item_name'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('item_name') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>نوع الخدمة</label>
                                                <select id="type" name="type" class="custom-select rounded-0">
                                                    <option value="0">
                                                        عيني
                                                    </option>
                                                    <option value="1">
                                                        مادي
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>هدف تقديم الخدمة</label>
                                                <input type="text" name="service_goal" class="form-control">
                                                @if ($errors->has('service_goal'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('service_goal') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>فترة تقديم الخدمة</label>
                                                <input type="text" name="service_period" class="form-control">
                                                @if ($errors->has('service_period'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('service_period') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>مصدر المعلومة</label>
                                                <input type="text" name="source" class="form-control">
                                                @if ($errors->has('source'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('source') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div><!-- /.row -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary font">
                                                حفظ<i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </div><!-- /.card-body -->
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