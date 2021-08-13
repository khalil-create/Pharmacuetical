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
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الاصناف</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">إضافة صنف</h3>
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
                            <form method="POST" action="{{ url('admin/storeItem') }}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="commercial_name">الاسم التجاري</label>
                                    <input type="text" name="commercial_name" class="form-control" id="commercial_name">
                                    @if ($errors->has('commercial_name'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('commercial_name') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="science_name">الاسم العلمي</label>
                                    <input type="text" name="science_name" class="form-control" id="science_name">
                                    @if ($errors->has('science_name'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('science_name') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                    <label for="unit" class="col-md-2 control-label">وحدة البيع</label>
                                        <select name="unit" id="unit" class="form-control custom-select rounded-0">
                                                <option value="باكت">باكت</option>
                                                <option value="شريط">شريط</option>
                                                <option value="قارورة">قارورة</option>
                                        </select>
                                        @if ($errors->has('unit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="price">السعر</label>
                                    <input type="text" name="price" class="form-control" id="price">
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="bonus">البونص ( % )</label>
                                    <input type="text" name="bonus" class="form-control" id="bonus">
                                    @if ($errors->has('bonus'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                    <label class="col-md-2 control-label">اسم المجموعة</label>
                                        <select name="category_id" id="category_id" class="form-control custom-select rounded-0">
                                            @foreach ($category as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name_cat}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="form-group" >
                                    <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                        حفظ<i class="fas fa-save"></i>
                                    </button>
                                </div>
                            </div>
                            </div>
                            </div>
                            <!-- /.col -->
                            
                            <!-- /.form-group -->
                        </form>
                        <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
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
@endsection