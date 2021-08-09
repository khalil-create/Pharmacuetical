@extends('layouts.index')
@section('title')
    ادارة المواد الترويجية
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة المواد الترويجية</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">المواد الترويجية</li>
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
                <h3 class="card-title" style="float: right">إضافة مادة ترويجية</h3>
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
                        <form method="POST" action="/repScience/storePromotionMaterial"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>الصنف المنافس</label>
                                <input type="text" name="item_name" class="form-control">
                                @if ($errors->has('item_name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('item_name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>نوع المادة الترويجية</label>
                                <input type="text" name="type" class="form-control">
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('type') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>المستهدفون</label>
                                <input type="text" name="targets" class="form-control">
                                @if ($errors->has('targets'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('targets') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sign_img_company">إرفاق الصورة</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                        <label class="custom-file-label" for="image"></label>
                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('image') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" >
                                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                                    حفظ<i class="fas fa-save"></i>
                                                </button>
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