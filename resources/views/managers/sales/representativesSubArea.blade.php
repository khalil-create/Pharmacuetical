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
          <h1 class="m-0">ادارة المناطق</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">مندوبين المنطقة</li>
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
            <span class="card-title" style="float: right"> قائمة المناديب التابعين للمنطقة الفرعية:-  <h5>
              @php
                  $exist = 1;
              @endphp
              @if (isset($subarea))
                  {{$subarea->name_sub_area}}
              @else
                  @php
                      $exist=0;
                  @endphp
                  {{'هذه المنطقة غير موجوده'}}
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
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if(isset($reps) && $reps->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم المندوب
                      </th>
                    </tr>
                  @elseif($exist == 1)
                    <div class="alert alert-danger notify-success">
                      {{ 'لايوجد مناديب لهذه المنطقة' }}                    
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($reps as $row)                  
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>{{$row->user->user_name_third}}</td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/managerSales/addRepresentative')}}" class="btn btn-primary add">
                      <i class="fas fa-plus"></i> اضافة مندوب</a>
                  </div>
                  </tbody>
                  <tfoot>
                  @if(isset($reps) && $reps->count() > 0)
                    <tr>
                      <th rowspan="1" colspan="1">#</th>
                      <th rowspan="1" colspan="1">اسم المندوب</th>
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
