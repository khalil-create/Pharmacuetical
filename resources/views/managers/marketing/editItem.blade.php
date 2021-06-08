@extends('layouts.index')
@section('title')
    تعديل الصنف
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v1</li>
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
                    <h3 class="card-title" style="float: right">تعديل الصنف</h3>
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
                                <form method="POST" action="/itemUpdate/{{$item->id}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="form-group">
                                        <label for="commercial_name">الاسم التجاري</label>
                                        <input type="text" value="{{$item->commercial_name}}" name="commercial_name" class="form-control" id="commercial_name">
                                        @if ($errors->has('commercial_name'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('commercial_name') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="science_name">الاسم العلمي</label>
                                        <input type="text" value="{{$item->science_name}}" name="science_name" class="form-control" id="science_name">
                                        @if ($errors->has('science_name'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('science_name') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                        <label for="unit" class="col-md-2 control-label">الوحده</label>
                                        <select name="unit" id="unit" class="form-control custom-select rounded-0">
                                                <option value="باكت"
                                                    @if($item->unit == 'باكت')
                                                        {{'selected'}}
                                                    @endif >باكت
                                                </option>
                                        </select>
                                        @if ($errors->has('unit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="price">السعر</label>
                                        <input type="text" value="{{$item->price}}" name="price" class="form-control" id="price">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="bonus">البونص</label>
                                        <input type="text" value="{{$item->bonus}}" name="bonus" class="form-control" id="bonus">
                                        @if ($errors->has('bonus'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                                        <label class="col-md-2 control-label">اسم المجموعة</label>
                                        <select name="category_id" id="category_id" class="form-control custom-select rounded-0">
                                            @foreach ($categories as $cats)
                                                <option value="{{$cats->id}}"
                                                    @if($cats->id == $item->category->id)
                                                        {{'selected'}}
                                                    @endif
                                                    >{{$cats->name_cat}}</option>
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
                                            تعديل <i class="fas fa-plus"></i>
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
@section('scripts')

@endsection