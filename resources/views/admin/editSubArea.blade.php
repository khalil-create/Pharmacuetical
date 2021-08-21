@extends('layouts.index')
@section('title')
    ادارة المناطق
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المناطق</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin/manageSubAreas">ادارة المناطق الفرعية</a></li>
                    <li class="breadcrumb-item active">المناطق الفرعية</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل المنطقة الفرعية</h3>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <form method="POST" action="/admin/UpdateSubArea/{{$subarea->id}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="card-body border">
                                        <div class="form-group col-md-6">
                                            <label>اسم المنطقة الفرعية</label>
                                            <input type="text" value="{{$subarea->name_sub_area}}" name="name_sub_area" class="form-control">
                                            @if ($errors->has('name_sub_area'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('name_sub_area') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">المنطقة الرئيسية التابعة لها</label>
                                            <select name="sub_area_id" class="form-control custom-select rounded-0">
                                                @foreach ($mainareas as $mainarea)
                                                    <option value="{{ $mainarea->id }}" 
                                                            @if ($subarea->mainarea_id == $mainarea->id)
                                                                {{ 'selected' }}
                                                            @endif    
                                                        >{{ $mainarea->name_main_area }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('sub_area_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('sub_area_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary font">
                                                تعديل <i class="fas fa-edit"></i>
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
</div><!-- /.content-wrapper -->
@endsection