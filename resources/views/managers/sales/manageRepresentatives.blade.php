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
            <h3 class="card-title" style="float: right">قائمة المندوبين</h3>
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
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم المندوب
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الصفة الوظيفية
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الجنس
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">
                        البريد الالكتروني
                      </th>
                      <th class="sorting align-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                        العملية
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($rep as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>
                        <img src="{{asset('images/users/'.$row->user->user_image)}}" class="img-users">
                        {{$row->user->user_name_third}} {{$row->user->user_surname}}
                      </td>
                      <td class="sorting_1">{{$row->user->user_type}}</td>
                      <td class="sorting_1">{{$row->user->sex}}</td>
                      <td class="" style="">{{$row->user->email}}</td>
                      <td class="" style="">
                        <a href="/managerSales/editRepresentative/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                        <a href="/managerSales/showSubareas/{{$row->id}}" title="مناطق المندوب"><i class="fas fa-tasks"></i></a>
                        <a href="/managerSales/showRepDetails/{{$row->id}}" title="تفاصيل"><i class="fas fa-eye"></i></a>
                        <input type="hidden" class="id" value="{{$row->id}}">
                        <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/managerSales/addRepresentative')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة مندوب</a>
                  </div>
                  </tbody>
                  <tfoot>
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">الاسم</th>
                        <th rowspan="1" colspan="1">الصفة الوظيفية</th>
                        <th rowspan="1" colspan="1">الجنس</th>
                        <th rowspan="1" colspan="1" style="">البريد الالكتروني</th>
                        <th rowspan="1" colspan="1" style="">العملية</th>
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
                        url: '/managerSales/deleteRepresentative/'+id,
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