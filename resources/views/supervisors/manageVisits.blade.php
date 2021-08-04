@extends('layouts.index')
@section('title')
    ادارة الزيارات
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الزيارات</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الزيارات</li>
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
            <h3 class="card-title" style="float: right">قائمة الزيارات</h3>
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
                  @if($supervisor->visits->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        العميل
                      </th> 
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        المندوب
                      </th> 
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        نوع الزيارة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        تأريخ الزيارة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        نتيجة الزيارة
                      </th>
                      <th class="sorting align-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-error">
                      {{ 'لم يتم اضافة اي زيارة' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($supervisor->visits as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>
                        @if ($row->customer_id != null)
                          {{$row->customer->name}}
                        @else
                          {{'د. '.$row->doctor->name}}
                        @endif
                      </td>
                      <td>
                        @if ($row->type == 1)
                            {{'مصحوبة مع المشرف/علمية'}}
                        @elseif($row->type == 2)
                            {{'عرض خدمة'}}
                        @else
                            {{'حل مشكلة'}}
                        @endif
                      </td>
                      <td>{{$row->representative->user->user_name_third}} {{$row->representative->user->user_surname}}</td>
                      <td>
                        {{$row->date}}
                      </td>
                      <td>
                        {{$row->result}}
                      </td>
                      <td>
                        {{-- <a href="/representative/editVisit/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a> --}}
                        {{-- <i class="fas fa-eye"></i> --}}
                        {{-- <form action="/representative/deleteVisit/{{$row->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -10px;"><i class="fas fa-trash"></i></button>
                        </form> --}}
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    {{-- <a href="{{url('/representative/addVisit')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة زيارة</a> --}}
                  </div>
                  </tbody>
                  <tfoot>
                    @if($supervisor->visits->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">العميل</th>
                        <th rowspan="1" colspan="1">المندوب</th>
                        <th rowspan="1" colspan="1">نوع الزيارة</th>
                        <th rowspan="1" colspan="1">تأريخ الزيارة</th>
                        <th rowspan="1" colspan="1">نتيجة الزيارة</th>
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
