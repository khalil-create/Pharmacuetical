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
            <li class="breadcrumb-item active">الاختبارات</li>
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
            <span class="card-title" style="float: right">قائمة الاختبارات</span>
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
                  {{-- @if($tests->count() > 0) --}}
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم الاختبار
                      </th>
                      {{-- <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الحالة
                      </th> --}}
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  {{-- @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم اضافة اي اختبار' }}
                    </div>
                  @endif --}}
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($tests as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>{{$row->test_name}}</td>
                      {{-- <td>
                        @if ($row->repSciences()->result == null)
                            {{'لم يتم الاحتبار'}}
                        @else
                            {{'تم الاختبار'}}
                        @endif
                      </td> --}}
                      <td>
                        <a href="/repScience/repTests/{{$row->id}}"><i class="nav-icon fas fa-question" title="الأسئلة"></i></a>
                        <a href="/repScience/showTestResult/{{$row->id}}"><i class="nav-icon fas fa-eye" title="نتيجة الاختبار"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/supervisor/addTest')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة اختبار</a>
                  </div>
                  </tbody>
                  <tfoot>
                    {{-- @if($tests->count() > 0) --}}
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1" style="">اسم الاختبار</th>
                        {{-- <th rowspan="1" colspan="1" style="">الحالة</th> --}}
                        <th rowspan="1" colspan="1" style="">العملية</th>
                      </tr>
                    {{-- @endif --}}
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
