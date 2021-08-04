@extends('layouts.index')
@section('title')
    ادارة المناطق
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة المناطق</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">المناطق الرئيسية</li>
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
            <h3 class="card-title" style="float: right">قائمة المناطق الرئيسية</h3>
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
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if($mainareas->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم المنطقة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        اسم المشرف عليها
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-error">
                      {{ 'لم يتم اضافة اي منطقة رئيسية' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($mainareas as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>{{$row->name_main_area}}</td>
                      <td class="sorting_1">
                        {{$row->supervisor->user->user_name_third}} {{$row->supervisor->user->user_surname}}
                      </td>
                      <td class="" style="">
                        <a href="/admin/editMainArea/{{$row->id}}"><i class="nav-icon fas fa-edit"></i></a>
                        <a href="/admin/supAreas/{{$row->id}}" class="btn btn-success">المناطق الفرعية</a>
                        <form action="/admin/deleteMainArea/{{$row->id}}" method="post" style="float: right;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button style="border: none;margin-left: -150px;"><i class="fas fa-trash"></i></button>
                        </form>
                        <i class="fas fa-eye"></i>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/admin/addMainArea')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة منطقة رئيسية</a>
                  </div>
                  </tbody>
                  <tfoot>
                    @if($mainareas->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">اسم المنطقة</th>
                        <th rowspan="1" colspan="1">اسم المشرف عليها</th>
                        <th rowspan="1" colspan="1" style="">العملية</th>
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
