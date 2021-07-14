@extends('layouts.index')
@section('title')
    النتيجة
@endsection
@section('content')
<div class="content-wrapper">
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">النتيجة النهائية</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    <p>{{ session('status') }}</p>

                                    <a href="" class="btn btn-primary">محاولة اخرى</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="result">
                        <p>النقاط الكلية: <span class="text-danger">{{ $grade }}</span> نقاط  من اصل <span class="text-danger">{{sizeof($question)}}</span> نقاط </p>
                        <p>النتيجة: <span class="text-danger">{{$grade*100/sizeof($question).'%'}}</span> </p>
                    </div>

                    {{-- <a href="" class="btn btn-primary">GET DETAILS IN PDF BY EMAIL</a> --}}

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                <thead>
                                @if($grade < sizeof($question))
                                <tr role="row">
                                    <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                                    #
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                    السؤال
                                    </th> 
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                    اجابتك
                                    </th>
                                    <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                                    الاجابة الصحيحة
                                    </th>
                                </tr>
                                @else
                                <div class="alert alert-success notify-success">
                                    {{ 'لايوجد لديك اي اخطاء' }}
                                </div>
                                @endif
                                </thead>
                                <tbody>
                                    <?php $i=1?>
                                    @if($grade < sizeof($question))
                                        {{-- @foreach ($question as $q) --}}
                                        @for ($i = 0; $i < sizeof($question); $i++)
                                            <tr class="odd">
                                                <td class="dtr-control" tabindex="0">{{$i+1}}</td>
                                                <td class="text-right">{{$question[$i]}}</td>
                                                <td class="@if($your_answered[$i] != $right_answer[$i]){{'text-danger'}}  @endif">{{$your_answered[$i]}}</td>
                                                <td>{{$right_answer[$i]}}</td>
                                            </tr>
                                            {{-- @php $i++; @endphp --}}
                                        {{-- @endforeach --}}
                                        @endfor
                                    @endif
                                </tbody>
                                <tfoot>
                                    @if($grade < sizeof($question))
                                        <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">السؤال</th>
                                        <th rowspan="1" colspan="1">اجابتك</th>
                                        <th rowspan="1" colspan="1">الاجابة الصحيحة</th>
                                        </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection