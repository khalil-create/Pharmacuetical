@extends('layouts.index')
@section('title')
    ادارة المناطق
@endsection
@section('content')
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
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-md-10">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr role="row">
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                            العدد
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                            الاسم
                          </th>
                          <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                            الجنس
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">
                            البريد الالكتروني
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                            العملية
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i=1?>
                      @foreach ($supervisor as $row)
                        <tr class="odd">
                          <td class="dtr-control" tabindex="0">{{$i++}}</td>
                          <td>
                            <img src="{{asset('images/users/'.$row->user_image)}}" class="img-users">
                            {{$row->user_name_third}} {{$row->user_surname}}
                          </td>
                          <td class="sorting_1">{{$row->sex}}</td>
                          <td class="" style="">{{$row->email}}</td>
                          <td class="" style="">
                            <a href="/editSupervisor/{{$row->id}}" class="btn btn-success" >تعديل</a>
                            <a href="/mainAreaSupervised/{{$row->id}}" class="btn btn-success"  >مناطق الإشراف</a>
                          </td>
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
                      </tbody>
                      <tfoot>
                        <tr>
                          <th rowspan="1" colspan="1">العدد</th>
                          <th rowspan="1" colspan="1">الاسم</th>
                          <th rowspan="1" colspan="1">الجنس</th>
                          <th rowspan="1" colspan="1" style="">البريد الالكتروني</th>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- ./wrapper -->
  </div>
</div>
@endsection
