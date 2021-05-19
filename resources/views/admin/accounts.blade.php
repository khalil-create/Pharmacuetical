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
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>العدد</th>
                    <th class="align-center">الاسم</th>
                    <th class="align-center">الصفة الوظيفية</th>
                    <th class="align-center">الجنس</th>
                    <th class="align-center">البريد الالكتروني</th>
                    <th class="align-center">رقم الهاتف</th>
                    <th colspan="2" class="align-center"> العملية</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1?>
                @foreach ($users as $row)
                <tr>
                  <td>{{$i++}}</td>
                  <td class="user-name"><img src="{{asset('images/users/'.$row->user_image)}}" class="img-users">
                        {{$row->user_name_third}} {{$row->user_surname}}
                  </td>
                  <td class="align-center">{{$row->user_type}}</td>
                  <td>{{$row->sex}}</td>
                  <td class="text-left">{{$row->email}}</td>
                  <td>{{$row->phone_number}}</td>
                  <td style="padding-left:10px">
                      <a href="/editUser/{{$row->id}}" class="btn btn-success" >تعديل</a>
                  </td>
                  <td>
                    <form action="/deleteUser/{{$row->id}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                  </td>
                </tr>
                @endforeach     
                {{-- <div class="d-flex justify-content-center">
                  {!! $users->links() !!}
                </div>           --}}
              </tbody>
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
                    {{-- <div class="d-flex justify-content-center">
                      {!! $users->links() !!}
                    </div> --}}
                  </div>
                </div>
                {{-- </div> --}}
              
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</div>
@endsection
