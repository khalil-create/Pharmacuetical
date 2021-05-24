@extends('layouts.index')
@section('title')
    ادارة الحسابات
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
    <div class="row">
      <div class="col-10">
        <div class="card">
          <div class="card-header">
            <span class="card-title" style="float: right">قائمة المستخدمين</span>
            <div class="card-tools float-right">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="card-title">
              <div class="input-group input-group-sm" style="width: 200px;margin-left:20px">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if($users->count() > 0)
                    <tr role="row">
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        العدد
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الاسم
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الصفة الوظيفية
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الجنس
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        البريد الالكتروني
                      </th>
                      {{-- <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        رقم الهاتف
                      </th> --}}
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-success notify-success">
                      {{ 'لم يتم اضافة اي مستخدم' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($users as $row)               
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>
                        <img src="{{asset('images/users/'.$row->user_image)}}" class="img-users">
                        {{$row->user_name_third}} {{$row->user_surname}}
                      </td>
                      <td>{{$row->user_type}}</td>
                      <td>{{$row->sex}}</td>
                      <td class="text-left">{{$row->email}}</td>
                      {{-- <td>{{$row->phone_number}}</td> --}}
                      <td>
                        <a href="/editUser/{{$row->id}}"><i style="margin: 2px 3px 2px 3px" class="nav-icon fas fa-edit"></i></a>
                        <form action="/deleteUser/{{$row->id}}" method="post" style="float: right;">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button style="border: none"><i class="fas fa-trash"></i></button>
                      </form>
                      <i class="fas fa-eye"></i>
                      {{-- <i class="fas fa-trash-alt"></i>                       --}}
                    </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/addUser')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة مستخدم</a>
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
                  @if($users->count() > 0)
                    <tr>
                      <th rowspan="1" colspan="1">العدد</th>
                      <th rowspan="1" colspan="1">الاسم</th>
                      <th rowspan="1" colspan="1">الصفة الوظيفية</th>
                      <th rowspan="1" colspan="1">الجنس</th>
                      <th rowspan="1" colspan="1">البريد الالكتروني</th>
                      {{-- <th rowspan="1" colspan="1">رقم الهاتف</th> --}}
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
