@extends('layouts.index')
@section('title')
    الاختبارات
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
            <span class="card-title" style="float: right">
              قائمة المندوبين في اختبار 
              <span class="bold">{{$test->test_name}}
                (
                  @if ($test->type == 0)
                      {{' صواب/خطأ '}}
                  @else
                      {{' اختيار متعدد '}}
                  @endif
                )
              </span>
            </span>
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
                <div class="alert alert-error notify-error">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if($test->representatives->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        المندوب
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم اضافة اي مندوب لهذا الاختبار' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @if ($test->representatives->count() > 0)
                    @foreach ($test->representatives as $row)
                      <tr class="odd">
                        <td class="dtr-control" tabindex="0">{{$i++}}</td>
                        <td>
                          <img src="{{asset('images/users/'.$row->user->user_image)}}" class="img-users">
                          {{$row->user->user_name_third}} {{$row->user->user_surname}}
                        </td>
                        <td>
                          <a href="/supervisor/manageQuestions/{{$row->id}}"><i class="nav-icon fas fa-plus kkk" title="الأسئلة"></i></a>
                          <a href="/supervisor/editTest/{{$row->id}}"><i class="nav-icon fas fa-edit kkk" title="تعديل"></i></a>
                          <form action="/supervisor/deleteTest/{{$row->id}}" method="post" style="float: right;">
                              {{csrf_field()}}
                              {{method_field('DELETE')}}
                              <button style="border: none;margin-left: -15px;"><i class="fas fa-trash" title="حذف"></i></button>
                            </form>
                            <a href="/supervisor/manageTestReps/{{$row->id}}"><i class="fas fa-eye" title="التفاصيل"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                  <div>
                    <a href="{{url('/supervisor/addTestReps',$test->id)}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة مندوبين لهذا الاختبار</a>
                  </div>
                  </tbody>
                  <tfoot>
                    @if($test->representatives->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1" style="">المندوب</th>
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
