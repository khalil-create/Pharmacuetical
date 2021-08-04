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
                <h3 class="card-title" style="float: right">تعديل مادة ترويجية</h3>
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
                        <form method="POST" action="/repScience/updatePromotionMaterial/{{$promotion->id}}"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>الصنف المنافس</label>
                                <input value="{{$promotion->competitor->item_name}}" type="text" name="item_name" class="form-control">
                                @if ($errors->has('item_name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('item_name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>نوع المادة الترويجية</label>
                                <input value="{{$promotion->type}}" type="text" name="type" class="form-control">
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('type') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>المستهدفون</label>
                                <input value="{{$promotion->targets}}" type="text" name="targets" class="form-control">
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
                                        <input value="{{asset('images/items/'.$promotion->image)}}" type="file" class="custom-file-input" name="image">
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
                                    تعديل <i class="fas fa-edit"></i>
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