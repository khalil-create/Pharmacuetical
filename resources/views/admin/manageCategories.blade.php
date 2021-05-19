@extends('layouts.index')
@section('title')
    ادارة مجموعات الاصناف 
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
            <span class="card-title" style="float: right">قائمة مجموعات الاصناف</span>
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
                @if($cat->count() > 0)
                  <tr>
                      <th>العدد</th>
                    <th>اسم المجموعة</th>
                    <th>اسم الشركة</th>
                    <th colspan="2"> العملية</th>
                  </tr>
                @else
                  <div class="alert alert-success notify-success">
                    {{ 'لم يتم اضافة اي مجموعة اصناف' }}
                  </div>
                @endif
              </thead>
              <tbody>
                <?php $i=1?>
                @foreach ($cat as $row)
                @foreach($row->companies as $comp)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$row->name_cat}}</td>
                      <td>{{$comp->name_company}}</td>
                      <td style="padding-left:  0px">
                          <a href="/editCategory/{{$row->id}}" class="btn btn-success" >تعديل</a>
                      </td>
                      <td style="padding-right: 0px">
                          <form action="/deleteCategory/{{$row->id}}" method="post" style="margin-right: -20px">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">حذف</button>
                          </form>
                      </td> 
                    </tr>
                @endforeach
                @endforeach
                <div>
                <a href="{{url('/addCategory')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة مجموعة اصناف</a>
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
