@extends('layouts.index')
@section('title')
    ادارة الاختبارات
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الاختبارات</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">فئات الاختبار</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- /.content-header -->
  <div>
    <div class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <span class="card-title" style="float: right">
              قائمة بـ أنواع الاختبار 
              <span class="bold">{{$test->test_name}}</span>
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
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        نوع الاختبار
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $MCQS = 1;
                        $TorF = 2;
                    @endphp
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{1}}</td>
                      <td>{{'اختيارات'}}</td>
                      <td>
                        <a href="{{route('manageQuestions',['id' => $test->id,'type'=>1])}}"><i class="nav-icon fas fa-question kkk" title="الأسئلة"></i></a>
                      </td>
                    </tr>
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{2}}</td>
                      <td>{{'صح/خطأ'}}</td>
                      <td>
                        <a href="{{route('manageQuestions',['id' => $test->id,'type'=>0])}}"><i class="nav-icon fas fa-question kkk" title="الأسئلة"></i></a>
                      </td>
                    </tr>
                  {{-- <div>
                    <a href="{{url('/supervisor/addTest')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة اختبار</a>
                  </div> --}}
                  </tbody>
                  <tfoot>
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1" style="">نوع الاختبار</th>
                        <th rowspan="1" colspan="1" style="">العملية</th>
                      </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>
@endsection
