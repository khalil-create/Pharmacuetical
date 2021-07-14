@extends('layouts.index')
@section('title')
    استخدامات الصنف
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
            <span class="card-title" style="float: right"> قائمة الاستخدامات للصنف :- <h5>
              @if(isset($item))    
                {{ $item->commercial_name }}
              @endif
            </h5></span>
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
                  @if(isset($item) && $item->uses->count() > 0)                    
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الاستخدام
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                  <div class="alert alert-success notify-success">
                    {{ 'لم يتم اضافة اي استخدام لهذا الصنف' }}               
                  </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php 
                    $i=1;
                  ?>
                  @if(isset($item))    
                  @foreach ($item->uses as $row)               
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>{{$row->use}}</td>
                      <td>
                        <a href="/supervisor/editUse/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                        <form action="/supervisor/deleteUse/{{$row->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -50px;"><i class="fas fa-trash"></i></button>
                          </form>
                      </td>
                    </tr>
                  @endforeach
                  @endif
                  <div>
                    <a href="/supervisor/addUse/{{$item->id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة استخدام</a>
                    @if($item->uses->count() > 0)
                      <a href="/supervisor/addUseExist/{{$item->id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة استخدامات موجودة</a>
                    @endif
                  </div>
                  </tbody>
                  <tfoot>
                  @if(isset($item) && $item->uses->count() > 0)                    
                    <tr>
                      <th rowspan="1" colspan="1">#</th>
                      <th rowspan="1" colspan="1">الاستخدام</th>
                      <th rowspan="1" colspan="1">العملية</th>
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
