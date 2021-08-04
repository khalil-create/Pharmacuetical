@extends('layouts.index')
@section('title')
    ادارة الأهداف البيعية
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الأهداف البيعية</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الأهداف البيعية</li>
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
              قائمة الهدف البيعي (<b>{{$salesObjective->objective}}</b>) الموزعة على المندوبين للصنف 
              (<b>{{$salesObjective->item->commercial_name}}</b>)
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
            <div class="row">
              <div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if($salesObjectives->count() > 0)                    
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      {{-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الصنف
                      </th> --}}
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        المندوب
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الهدف
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم توزيع هذا الهدف البيعي' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1;$sum_count = 0; ?>
                  @foreach ($salesObjectives as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      {{-- <td>{{ $row->item->commercial_name }}</td> --}}
                      <td>
                        {{ $row->representative->user->user_name_third }} {{ $row->representative->user->user_surname }}
                      </td>
                      <td>
                        @php
                            $sum_count += $row->objective;
                        @endphp
                        {{ $row->objective }}
                      </td>
                      <td>
                        <a href="/supervisor/editDividedSalesObjective/{{$row->id}}"><i class="nav-icon fas fa-edit"></i></a>
                        {{-- <form action="/supervisor/deleteDividedSalesObjective/{{$salesObjective->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -100px;"><i class="fas fa-trash"></i></button>
                        </form> --}}
                        <input type="hidden" class="id" value="{{$salesObjective->id}}">
                        <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                        {{-- <i class="fas fa-eye"></i> --}}
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    {{-- @if(!($salesObjective->objective <= $sum_count))
                        <a href="/supervisor/addDividedSalesObjective/{{$salesObjective->id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة عينة</a>
                    @endif --}}
                    <div style="margin-bottom: 10px">
                      {{'الباقي من الاهداف الموزعه : '}} <small class="text-danger">{{$salesObjective->objective - $sum_count}}</small>
                    </div>
                  </div>
                  </tbody>
                  <tfoot>
                    @if($salesObjectives->count() > 0)                    
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        {{-- <th rowspan="1" colspan="1">الصنف</th> --}}
                        <th rowspan="1" colspan="1">المندوب</th>
                        <th rowspan="1" colspan="1">الهدف</th>
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
@section('script')
  <script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.DeleteBtn').click(function(e){
            e.preventDefault();
            var id = $(this).closest("tr").find('.id').val();
            
            swal({
                title: "هل انت متأكد من حذف البيانات?",
                text: "عند حذفك للبيانات المحددة لايمكنك استرجاعها!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    var data = {
                        "_token": $('input[name=_token]').val(),
                        "id": id,
                    };
                    $.ajax({
                        type: "DELETE",
                        url: '/supervisor/deleteDividedSalesObjective/'+id,
                        data: data,
                        // dataType: "data"
                        success: function(response){
                            swal(response.status, {
                                icon: "success",
                            })
                            .then((result) =>{
                                location.reload();
                            });
                        }
                    });
                    
                }
            });
        });
    });
  </script>
@endsection