@extends('layouts.index')
@section('title')
    ادارة المهام
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة المهام</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home+">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">المهام</li>
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
            <span class="card-title" style="float: right"> قائمة مهام مطلوبه</span>
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
                  @if($tasks->count() > 0)                    
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        المهمه
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الوصف
                      </th> 
                      {{-- <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        المشرف
                      </th> --}}
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        اخر تأريخ للتنفيذ
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الحالة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم اضافة اي مهمة' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                    <?php $i=1?>
                    @foreach ($tasks as $row)
                      <tr class="odd">
                        <td class="dtr-control" tabindex="0">{{$i++}}</td>
                        <td>{{ $row->task_title }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->last_date }}</td>
                        <td>
                          @if ($row->performed == 0)
                              <b class="text-danger">{{'لم يتم انجازها'}}</b>
                          @else
                              <b class="text-success">{{'تم انجازها'}}</b>
                          @endif
                        </td>
                        <td>
                          @if ($row->performed == 0)
                              <a href="/repScience/performTask/{{$row->id}}"><i class="fas fa-play" title="تنفيذ المهمة"></i></a>
                          @else
                              <a href="/repScience/performTask/{{$row->id}}"><i class="fas fa-edit" title="تعديل تنفيذ المهمة"></i></a>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    @if($tasks->count() > 0)                    
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">المهمه</th>
                        <th rowspan="1" colspan="1">الوصف</th>
                        {{-- <th rowspan="1" colspan="1">المشرف</th --}}
                        <th rowspan="1" colspan="1">اخر تأريخ للتنفيذ</th>
                        <th rowspan="1" colspan="1">الحالة</th>
                        <th rowspan="1" colspan="1">العملية</th>
                      </tr>
                    @endif
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
