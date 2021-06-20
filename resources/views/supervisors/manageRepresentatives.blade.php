@extends('layouts.index')
@section('title')
    ادارة المناديب
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
            <h3 class="card-title" style="float: right">قائمة المناديب</h3>
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
                  @if($rep->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم المندوب
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الصفة الوظيفية
                      </th>
                      {{-- <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        المشرف
                      </th> --}}
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الجنس
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">
                        البريد الالكتروني
                      </th>
                      <th class="sorting align-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-success notify-success">
                      {{ 'لم يتم اضافة اي مندوب' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($rep as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>
                        <img src="{{asset('images/users/'.$row->user->user_image)}}" class="img-users">
                        {{$row->user->user_name_third}} {{$row->user->user_surname}}
                      </td>
                      <td class="sorting_1">{{$row->user->user_type}}</td>
                      {{-- <td class="sorting_1">
                        {{$row->supervisor->user->user_name_third}} {{$row->supervisor->user->user_surname}}
                      </td> --}}
                      <td class="sorting_1">{{$row->user->sex}}</td>
                      <td class="" style="">{{$row->user->email}}</td>
                      <td class="" style="">
                        <a href="/supervisor/editRepresentative/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                        <a href="/supervisor/showMainareas/{{$row->id}}" ><i class="fas fa-tasks"></i></a>
                        <i class="fas fa-eye"></i>
                        <form action="/Supervisor/deleteRepresentative/{{$row->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -10px;"><i class="fas fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/supervisor/addRepresentative')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة مندوب</a>
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
                    @if($rep->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">الاسم</th>
                        <th rowspan="1" colspan="1">الصفة الوظيفية</th>
                        {{-- <th rowspan="1" colspan="1">المشرف</th> --}}
                        <th rowspan="1" colspan="1">الجنس</th>
                        <th rowspan="1" colspan="1" style="">البريد الالكتروني</th>
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
