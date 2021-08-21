@extends('layouts.index')
@section('title')
    ادارة مندوبين المبيعات
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">ادارة مندوبين المبيعات</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/managerSales/manageRepresentatives">ادارة مندوبيين المبيعات</a></li>
                <li class="breadcrumb-item active">مندوبين المبيعات</li>
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
                <span class="card-title" style="float: right"> قائمة المناطق الفرعية للمندوب :-  <span class="text-bold">
                {{$rep->user->user_name_third}} {{$rep->user->user_surname}}
                </span></span>
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
                        <tr role="row">
                        <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                            #
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                            اسم المنطقة الفرعية
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i=1?>
                    @foreach ($subareas as $row)                  
                        <tr class="odd">
                        <td class="dtr-control" tabindex="0">{{$i++}}</td>
                        <td>{{$row->name_sub_area}}</td>
                        </tr>
                    @endforeach
                    <div>
                        <a href="{{url('/managerSales/addRepSubareas',$rep->id)}}" class="btn btn-primary add">
                        <i class="fas fa-plus"></i> اضافة مناطق</a>
                    </div>
                    </tbody>
                    <tfoot>
                        <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">اسم المنطقة الفرعية</th>
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
        </div>
    </div>
</div>
@endsection
