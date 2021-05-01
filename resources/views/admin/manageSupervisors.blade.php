@extends('layouts.index')
@section('title')
    ادارة المشرفين
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
            <span class="card-title" style="float: right">قائمة المشرفين</span>
            <div class="card-tools float-right">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="card-title">
              <div class="input-group input-group-sm" style="width: 200px;margin-left:10px">
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
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>            
                @if($supervisor->count() > 0)
                  <tr>
                    <th>العدد</th>
                    <th>اسم المشرف</th>
                    <th>الجنس</th>
                    <th>البريد الالكتروني</th>
                    <th colspan="2" class="align-center"> العملية</th>
                  </tr>
                @else
                  <div class="alert alert-success notify-success">
                    {{ 'لم يتم اضافة اي مشرف' }}
                  </div>
                @endif
              </thead>
              <tbody>
                <?php $i=1?>
                @foreach ($supervisor as $row)
                <tr>
                  <td>{{$i++}}</td>
                  <td class="user-name"><img src="{{asset('images/users/'.$row->user_image)}}" class="img-users">
                        {{$row->user_name_third}} {{$row->user_surname}}
                  </td>
                  <td>{{$row->sex}}</td>
                  <td>{{$row->email}}</td>
                  <td style="">
                      <a href="/editSupervisor/{{$row->id}}" class="btn btn-success" >تعديل</a>
                  </td>
                  <td>
                      <a href="/mainAreaSupervised/{{$row->id}}" class="btn btn-success"  >مناطق الإشراف</a>
                  </td>
                  {{-- <td> 
                    <form action="/deleteSupervisor/{{$row->id}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                    <a href="/deleteSupervisor/{{$row->id}}" class="btn btn-danger">حذف</a> 
                  </td> --}}
                </tr>
                @endforeach
                <div>
                    <a href="{{url('/addSupervisor')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة مشرف</a>
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
                </div>
                  
                </div>
              </tbody>
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
