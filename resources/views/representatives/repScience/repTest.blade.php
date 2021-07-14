@extends('layouts.index')
@section('title')
    اسئلة الاختبار
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
                    <h3 class="card-title" style="float: right">
                        قائمة الأسئلة
                        <span class="bold">{{$test1->test_name}}</span>
                    </h3>
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
                        <div>
                            <form method="POST" action="/representative/storeRepTest/{{$test1->id}}" onsubmit="return Validation()"  enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                @php
                                    $i = 0;
                                @endphp
                                <div class="question-border">
                                    @foreach ($tests as $test)
                                        @foreach ($test->questions as $q)
                                            <div class="shift">
                                                <div>
                                                    <p class="bold">{{'السؤال_'}}{{++$i.' - '}} {{$q->question}}</p>
                                                    <input type="text" value="{{$q->question}}" name="questions[{{$q->id}}]" hidden>
                                                    <input type="text" value="{{$test->type}}" name="type[]" hidden>
                                                    <input type="text" value="{{$q->id}}" name="questionid[]" hidden>
                                                    <input type="text" value="{{$q->right_answer}}" name="right_answer[]" hidden>
                                                </div>
                                                
                                                {{-- <input name="type" type="text" value="{{$type}}" hidden> --}}
                                                @if($test->type == 1)
                                                    <div>
                                                        <div class="col-md-12">
                                                            <div>
                                                                <div class="row">
                                                                    @php
                                                                        $choices = $q->choices;
                                                                        $choices_arr = explode("++",$choices);
                                                                    @endphp
                                                                    <div class="col-12 margin">
                                                                        @foreach ($choices_arr as $choice)
                                                                            <p><input onchange="increased()" class="form-check-input" type="radio" name="answered_choice[{{$q->id}}]" value="{{$choice}}">{{$choice}}</p>
                                                                            @if($errors->has("answered_choice.$q->id"))
                                                                                <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                                                    <strong>{{ $errors->first("answered_choice.$q->id") }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        @endforeach
                                                                        <hr class="line">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div>
                                                        <div class="col-md-12">
                                                            <div>
                                                                <div class="row">
                                                                    <div class="col-12 margin">
                                                                        <p>
                                                                            <input onchange="increased()" class="form-check-input" type="radio" name="answered_TorF[{{$q->id}}]" value="صواب">
                                                                            <label class="form-check-label">صواب</label>
                                                                        </p>
                                                                        <p>
                                                                            <input onchange="increased()" class="form-check-input" type="radio" name="answered_TorF[{{$q->id}}]" value="خطأ">
                                                                            <label class="form-check-label">خطأ</label>
                                                                        </p>
                                                                    </div>
                                                                    @if($errors->has("answered_TorF.$q->id"))
                                                                        <span style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                                                            <strong>{{ $errors->first("answered_TorF.$q->id") }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <hr class="line">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endforeach
                                    {{-- <input type="text" value="{{$i}}" id="count_q" hidden>
                                    <input type="text" value="0" id="clicked" hidden> --}}
                                    <div class="form-group" id="send_btn">
                                        <button type="submit" class="btn btn-primary font" style="margin: 10px">
                                            ارسال <i class="fas fa-send"></i>
                                        </button>
                                    </div>
                                    {{-- <span id="not_completed" style="margin-top: .25rem; font-size: 80%; color: #e3342f;" role="alert">
                                        <strong>{{'لم يتم اكمال جميع الاسئلة'}}</strong>
                                    </span> --}}
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