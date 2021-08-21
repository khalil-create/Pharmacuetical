@extends('layouts.index')
@section('title')
    ادارة المندوبين
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة المندوبين</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/managerMarketing/manageRepresentatives">ادارة المندوبين</a></li>
                    <li class="breadcrumb-item active">مناطق المندوب</li>
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
                    <span class="card-title" style="float: right">اضافة مناطق فرعية للمندوب :-
                    <span class="text0bold">
                        @if (isset($rep))
                            {{$rep->user->user_name_third}} {{$rep->user->user_surname}}
                        @endif
                    </span>
                    التابعه للمشرف :- 
                    <span class="text-bold">{{$rep->supervisor->user->user_name_third}} {{$rep->supervisor->user->user_surname}}</span> 
                    </span>
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
                                @if($subareas->count() > 0)
                                    <form method="POST" action="/managerMarketing/storeRepSubareas/{{$rep->id}}"  enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="usesIds" class="col-md-6 control-label">اختر المناطق الفرعية</label>
                                                <select name="subareasids[]" id="exist_uses" class="form-control custom-select rounded-0" multiple>
                                                    @foreach ($subareas as $sub)
                                                        <option value="{{$sub->id}}">{{$sub->name_sub_area}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('subareasids'))
                                                    <span class="help-block">
                                                        <small class="form-text text-danger">{{ $errors->first('subareasids') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group" >
                                                <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                                    حفظ<i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        <!-- /.form-group -->
                                    </form>
                                @else
                                    <div class="alert alert-danger notify-danger">
                                        {{ 'لم يتم اضافة اي منطقة فرعية لهذه المنطقة الرئيسية الرجاء اضافة المناطق الفرعية من ادارة المناطق' }}               
                                    </div>
                                @endif
                            </div>
                            <!-- / form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection