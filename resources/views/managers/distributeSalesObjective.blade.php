@extends('layouts.index')
@section('title')
      توزيع الاهداف البيعية
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
            <span class="card-title" style="float: right">توزيع الهدف البيعي على المشرفين</span>
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
            <div class="row col-14">
              <form style="width: 100%" method="POST" action="/storeDistributedSalesObjForSup" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="col-sm-12">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                          المشرف</th>
                        <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                          الهدف</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($supervisors as $row)
                      <tr>
                        <td>
                          <label style="float: right">{{$row->user->user_name_third}} {{$row->user->user_surname}}</label>
                        </td>
                        <td>
                          <input type="text" placeholder="الهدف البيعي لهذا المشرف" name="objective[]" class="form-control">
                          @if ($errors->has('objective'))
                            <span class="help-block">
                                <small class="form-text text-danger">{{ $errors->first('objective') }}</small>
                            </span>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                <button type="submit" class="btn btn-primary font" style="margin: 10px">
                  اضافة <i class="fas fa-plus"></i>
                </button>
              </form>
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
