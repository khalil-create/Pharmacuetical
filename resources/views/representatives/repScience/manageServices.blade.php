@extends('layouts.index')
@section('title')
    ادارة الخدمات
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
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
  <!-- /.content-header -->
  <div>
    <div class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title" style="float: right">قائمة الخدمات</h3>
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
                  @if($services->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        نوع الخدمة
                      </th> 
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم الخدمة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        تكلفة الخدمة 
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        مالكين الخدمة 
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">
                        الحالة
                      </th>
                      <th class="sorting align-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-success notify-success">
                      {{ 'لم يتم اضافة اي خدمة' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($services as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>
                        @if ($row->type)
                          {{'مادي'}}
                        @else
                          {{'عيني'}}
                        @endif
                      </td>
                      <td>
                        @if ($row->type == 1)
                            {{$row->name}}
                        @else
                            {{'---'}}
                        @endif
                      </td>
                      <td>
                        {{$row->cost}} 
                      </td>
                      <td>
                        @if($row->doctors->count() > 0)
                            @foreach ($row->doctors as $d)
                                {{'د. '.$d->name}}<br>
                            @endforeach
                        @elseif($row->customers->count() > 0)
                            @foreach ($row->customers as $cust)
                                {{$cust->name}}<br>
                            @endforeach
                        @endif
                      </td>
                      <td>
                        @if ($row->statues)
                        <b style="color:#0bab30">{{'مفعل'}}</b>
                        @else
                          <b style="color:hsl(0, 96%, 51%)">{{'غير مفعل'}}</b>
                        @endif
                      </td>
                      <td>
                        <a href="/representative/editService/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                        <i class="fas fa-eye"></i>
                        <form action="/representative/deleteService/{{$row->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -10px;"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/representative/addService')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة خدمة</a>
                    @if (session('status'))
                      <div class="alert alert-success notify-success">
                          {{ session('status') }}
                      </div>
                    @endif
                    @if (session('error'))
                      <div class="alert alert-danger notify-error">
                          {{ session('error') }}
                      </div>
                    @endif
                  </div>
                  </tbody>
                  <tfoot>
                    @if($services->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">نوع الخدمة</th>
                        <th rowspan="1" colspan="1">اسم الخدمة</th>
                        <th rowspan="1" colspan="1">تكلفة الخدمة</th>
                        <th rowspan="1" colspan="1">مالكين الخدمة</th>
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