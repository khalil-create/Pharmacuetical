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
            <span class="card-title" style="float: right"> قائمة المناطق الفرعية الخاصة بالمنطقة الرئيسية <h5>
                  {{ $mainarea->name_main_area }}
            </h5></span>
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
            <a href="/addSubArea/{{$mainarea->id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة منطقة</a>
            @if (session('status'))
                <div class="alert alert-success notify-success">
                    {{ session('status') }}
                </div>
            @endif
            <table class="table table-hover text-nowrap">
              @if(isset($subareas) && $exist == 1)
                  <thead>
                    <tr>
                      <th id="name_area" class="align-right" style="padding-right: 14px;">اسم المنطقة الرئيسية</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($subareas as $row)
                      <tr>
                        <td class="align-right" style="padding-right: 14px;">{{$row->name_sub_area}}</td>
                      </tr>
                    @endforeach
              @endif
              @if($exist == 0)
                  <div>
                      <div class="alert alert-success notify-success">
                          {{ 'لايوجد مناطق فرعية لهذه المنطقة الرئيسية' }}
                      </div>
                  </div>
                @endif
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
