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
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">المناطق الفرعية</li>
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
                    <h3 class="card-title" style="float: right">تعديل المنطقة الفرعية</h3>
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
                            <form method="POST" action="/managerSales/UpdateSubArea/{{$subarea->id}}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name_sub_area">اسم المنطقة الفرعية</label>
                                    <input type="text" value="{{$subarea->name_sub_area}}" name="name_sub_area" class="form-control">
                                    @if ($errors->has('name_sub_area'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('name_sub_area') }}</small>
                                        </span>
                                    @endif
                                </div>
                                @php $selected = "selected"; @endphp
                                <div class="form-group{{ $errors->has('mainrea_id') ? ' has-error' : '' }}">
                                    <label for="mainrea_id" class="col-md-6 control-label">المنطقة الرئيسية التابعة لها</label>
                                    <select name="mainrea_id" class="form-control custom-select rounded-0">
                                        @foreach ($mainareas as $areas)
                                            <option value="{{ $areas->id }}" 
                                                    @if ($mainarea->id == $areas->mainrea_id)
                                                        {{ $selected }}
                                                    @endif    
                                                >{{ $areas->name_main_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('mainrea_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mainrea_id') }}</strong>
                                        </span>
                                    @endif
                                    {{-- </div> --}}
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