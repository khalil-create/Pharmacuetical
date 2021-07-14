@extends('layouts.index')
@section('title')
    الاختبارات
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
                    <span class="card-title" style="float: right">
                        إضافة مندوبين في اختبار 
                        <span class="bold">{{$test->test_name}}
                        (
                            @if ($test->type == 0)
                                {{' صواب/خطأ '}}
                            @else
                                {{' اختيار متعدد '}}
                            @endif
                        )
                        </span>
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
                                <form method="POST" action="{{ url('supervisor/storeTestReps',$test->id) }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="col-md-6 control-label">
                                                المندوبين <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من مندوب)</span></label>
                                            <select name="repIds[]" class="form-control custom-select rounded-0" multiple>
                                                @php
                                                    $n = 1;
                                                @endphp
                                                @foreach ($reps as $rep)
                                                    <option value="{{$rep->id}}">{{$n++}}{{'- '}} {{$rep->user->user_name_third}} {{$rep->user->user_surname}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('repIds'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('repIds') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group" >
                                            <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                                اضافة <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    <!-- /.form-group -->
                                </form>
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