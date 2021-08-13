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
            <li class="breadcrumb-item active">المناطق الفرعية</li>
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
            <span class="card-title" style="float: right">قائمة المناطق الفرعية</span>
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
                  @if($subAreas->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        المنطقة الفرعية
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        منطقتها الرئيسية
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-error">
                    {{ 'لم يتم اضافة اي منطقة فرعية' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @if($subAreas->count() > 0)
                    @foreach ($subAreas as $area)
                      <tr class="odd">
                        <td class="dtr-control" tabindex="0">{{$i++}}</td>
                        <td>
                          {{$area->name_sub_area}}
                        </td>
                        <td class="sorting_1">{{$area->mainarea->name_main_area}}</td>
                        <td>
                          <a href="/managerSales/editSubArea/{{$area->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                          <input type="hidden" class="id" value="{{$area->id}}">
                          <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                          <a href="/managerSales/showSubareaReps/{{$area->id}}" ><i class="fas fa-tasks"></i></a>
                          <i class="fas fa-eye"></i>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                  <div>
                    <a href="{{url('/managerSales/addSubArea/0')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة منطقة فرعية</a>
                  </div>
                  </tbody>
                  <tfoot>
                    @if($subAreas->count() > 0)
                    <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">المنطقة الفرعية</th>
                        <th rowspan="1" colspan="1">منطقتها الرئيسية</th>
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
                        url: '/managerSales/deleteSubArea/'+id,
                        data: data,
                        // dataType: "data"
                        success: function(response){
                            swal(response.status, {
                                icon: "success",
                                button: "حسناً!",
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