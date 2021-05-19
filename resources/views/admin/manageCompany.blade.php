@extends('layouts.index')
@section('title')
    ادارة الشركات 
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
            <span class="card-title" style="float: right">قائمة الشركات</span>
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
                @if($company->count() > 0)
                  <tr>
                    <th>العدد</th>
                    <th>اسم الشركة</th>
                    <th>بلد التصنيع</th>
                    <th>اسم المشرف عليها</th>
                    <th colspan="2"> العملية</th>
                  </tr>
                @else
                  <div class="alert alert-success notify-success">
                    {{ 'لم يتم اضافة اي شركة' }}
                  </div>
                @endif
              </thead>
              <tbody>
                <?php $i=1?>
                @foreach ($company as $row)
                        <tr>
                          <td>{{$i++}}</td>
                          <td>
                            <img src="{{asset('images/signsCompany/'.$row->sign_img_company)}}" class="img-users">
                            {{ $row->name_company }} 
                          </td>
                          <td>{{ $row->country_manufacturing }}</td>
                          <td>{{$row->supervisor->user->user_name_third}} {{$row->supervisor->user->user_surname}}</td>
                          <td style="padding-left:  0px">
                              <a href="/editCompany/{{$row->id}}" class="btn btn-success">تعديل</a>
                          </td>
                          <td style="padding-right: 0px">
                              <form action="/deleteCompany/{{$row->id}}" method="post" style="margin-right: -20px">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger">حذف</button>
                              </form>
                          </td> 
                        </tr>
                @endforeach
                <div>
                <a href="{{url('/addCompany')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة شركة</a>
                    @if (session('status'))
                        <div class="alert alert-success notify-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                              <div class="alert alert-success notify-error">
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
