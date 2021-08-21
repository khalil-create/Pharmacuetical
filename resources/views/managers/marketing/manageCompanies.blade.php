@extends('layouts.index')
@section('title')
    ادارة الشركات 
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الشركات</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/managerMarketing/manageCompanies">ادارة الشركات</a></li>
            <li class="breadcrumb-item active">الشركات</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
    <div class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <span class="card-title" style="float: right">قائمة الشركات</span>
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
<<<<<<< HEAD
=======
                  {{-- @if($company->count() > 0)                     --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        اسم الشركة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        بلد التصنيع
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        اسم المشرف عليها
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
<<<<<<< HEAD
=======
                  {{-- @else
                    <div class="alert alert-danger notify-error">
                      {{ 'لم يتم اضافة اي شركة' }}
                    </div>
                  @endif --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($company as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>
                        <img src="{{asset('images/signsCompany/'.$row->sign_img_company)}}" class="img-users">
                            {{ $row->name_company }} 
                      </td>
                      <td>{{ $row->country_manufacturing }}</td>
                      <td>
                        {{$row->supervisor->user->user_name_third}} {{$row->supervisor->user->user_surname}}
                      </td>
<<<<<<< HEAD
                      <td>
=======
                      <td class="" style="">
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                        <a href="/managerMarketing/companyEdit/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                        <input type="hidden" class="id" value="{{$row->id}}">
                        <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                        <a href="/managerMarketing/showCompanyDetails/{{$row->id}}"><i class="nav-icon fas fa-eye" title="تفاصيل"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/managerMarketing/companyAdd')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة شركة</a>
                  </div>
                  </tbody>
                  <tfoot>
<<<<<<< HEAD
=======
                    {{-- @if($company->count() > 0)                     --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">اسم الشركة</th>
                        <th rowspan="1" colspan="1">بلد التصنيع</th>
                        <th rowspan="1" colspan="1">اسم المشرف عليها</th>
                        <th rowspan="1" colspan="1" style="">العملية</th>
                      </tr>
<<<<<<< HEAD
=======
                    {{-- @endif --}}
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                  </tfoot>
                </table>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div><!-- /.card -->
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
                        url: '/managerMarketing/companyDelete/'+id,
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