@extends('layouts.index')
@section('title')
    ادارة الاصناف 
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
            <span class="card-title" style="float: right">قائمة الاصناف</span>
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
                  @if($items->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الاسم التجاري
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الاسم العلمي
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        السعر
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        البونص
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الوحدة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        اسم المجموعة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-success notify-success">
                      {{ 'لم يتم اضافة اي صنف' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($items as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>{{$row->commercial_name}}</td>
                      <td>{{$row->science_name}}</td>
                      <td>{{$row->price}}</td>
                      <td class="sorting_1">{{$row->bonus}}</td>
                      <td class="sorting_1">{{$row->unit}}</td>
                      <td class="sorting_1">{{$row->category->name_cat}}</td>
                      <td class="" style="">
                        <a href="/managerMarketing/itemEdit/{{$row->id}}"><i class="nav-icon fas fa-edit kkk"></i></a>
                        <a href="/managerMarketing/itemUses/{{$row->id}}"><i class="fas fa-info"></i></a>
                        <form action="/managerMarketing/itemDelete/{{$row->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -25px;"><i class="fas fa-trash"></i></button>
                          </form>
                          <a href="/managerMarketing/showDetails/{{$row->id}}"><i class="fas fa-eye"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/managerMarketing/itemAdd')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة صنف</a>
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
                  </tbody>
                  <tfoot>
                    @if($items->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">الاسم التجاري</th>
                        <th rowspan="1" colspan="1">الاسم العلمي</th>
                        <th rowspan="1" colspan="1">السعر</th>
                        <th rowspan="1" colspan="1">البونص</th>
                        <th rowspan="1" colspan="1">الوحدة</th>
                        <th rowspan="1" colspan="1">اسم المجموعة</th>
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
