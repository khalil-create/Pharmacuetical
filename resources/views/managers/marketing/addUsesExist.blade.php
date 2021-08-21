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
                        <li class="breadcrumb-item"><a href="/managerMarketing/manageItem">ادارة الاصناف</a></li>
                        <li class="breadcrumb-item active">استخدامات الاصناف</li>
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
                    <h3 class="card-title" style="float: right">إضافة استخدامات موجودة</h3>
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
                                @if($uses->count() > 0)
                                    <form method="POST" action="{{ url('managerMarketing/storeUsesExist') }}"  enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="card-body border">
                                            <div class="form-group">
                                                <label for="usesIds" class="col-md-6 control-label">استخدامات موجودة</label>
                                                <select name="usesIds[]" id="exist_uses" class="form-control custom-select rounded-0" multiple>
                                                    @php
                                                        $n = 1;
                                                    @endphp
                                                    @foreach ($uses as $use)
                                                        <option value="{{$use->id}}">{{$n++}}{{'- '}} {{$use->use}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('usesIds'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('usesIds') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <input type="text" name="id" value="{{$id}}" hidden>
                                            <div class="form-group" >
                                                <button type="submit" class="btn btn-primary font">
                                                    حفظ<i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        </div><!-- /.card-body -->
                                    </form>
                                @else
                                    <div class="alert alert-success notify-success">
                                        {{ 'لم يتم اضافة اي استخدام' }}               
                                    </div>
                                    <a href="/admin/addUse/{{$id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة استخدام</a>
                                @endif
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