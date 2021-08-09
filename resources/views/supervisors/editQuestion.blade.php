@extends('layouts.index')
@section('title')
    ادارة اسئلة الاختبار
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">ادارة الاسئلة</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">اسئلة الاختبار</li>
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
                    <h3 class="card-title" style="float: right">تعديل سؤال</h3>
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
                            <form method="POST" action="/supervisor/updateQuestion/{{$question->id}}"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label>السؤال</label>
                                    <input value="{{$question->question}}" type="text" name="question" class="form-control">
                                    @if ($errors->has('question'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('question') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <input name="type" type="text" value="{{$type}}" hidden>
                                <input name="test_id" type="text" value="{{$test_id}}" hidden>
                                @if($type == 1)
                                    <div class="form-group">
                                        <div class="khalil col-md-12">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">الاختيارات</h3>
                                            </div>
                                            @php
                                                $choices = $question->choices;
                                                $choices_arr = explode("++",$choices);
                                            @endphp
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input value="{{$choices_arr[0]}}" type="text" id="choice1" name="choice1" class="form-control" placeholder="الاختيار الاول">
                                                        @if ($errors->has('choice1'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('choice1') }}</small>
                                                            </span>
                                                        @endif
                                                    </div><br><br>
                                                    <div class="col-12">
                                                        <input value="{{$choices_arr[1]}}" type="text" id="choice2" name="choice2" class="form-control" placeholder="الاختيار الثاني">
                                                        @if ($errors->has('choice2'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('choice2') }}</small>
                                                            </span>
                                                        @endif
                                                    </div><br><br>
                                                    <div class="col-12">
                                                        <input value="{{$choices_arr[2]}}" type="text" id="choice3" name="choice3" class="form-control" placeholder="الاختيار الثالث">
                                                        @if ($errors->has('choice3'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('choice3') }}</small>
                                                            </span>
                                                        @endif
                                                    </div><br><br>
                                                    <div class="col-12">
                                                        <input value="{{$choices_arr[3]}}" type="text" id="choice4" name="choice4" class="form-control" placeholder="الاختيار الرابع">
                                                        @if ($errors->has('choice4'))
                                                            <span class="help-block">
                                                                <small class="form-text text-danger">{{ $errors->first('choice4') }}</small>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">الاجابة الصحيحة</label>
                                        <input value="{{$question->right_answer}}" onkeyup="checkAnswer()" type="text" id="right_answer" name="right_answer" class="form-control">
                                        <small class="form-text text-danger" id="error_answer" hidden>{{'يجب ان تكون الاجابة واحده من الاختيارات'}}</small>
                                        @if ($errors->has('right_answer'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('right_answer') }}</small>
                                        </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="form-group">
                                        <div class="khalil col-md-12">
                                            <div class="card-header">
                                                <h3 class="card-title" style="float: right">الاجابة الصحيحة</h3>
                                            </div>
                                            @php
                                                $True = '';
                                                $False = '';
                                                if($question->right_answer == 'خطأ')
                                                    $False = 'checked';
                                                else
                                                    $True = 'checked';
                                            @endphp
                                            <div class="card-body">
                                                <div class="row radiobox">
                                                    <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="right_answer" value="صواب" {{$True}}>
                                                                <label class="form-check-label">صواب</label>
                                                            </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="right_answer" value="خطأ" {{$False}}>
                                                            <label class="form-check-label">خطأ</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                @endif
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