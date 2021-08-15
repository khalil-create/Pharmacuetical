@extends('layouts.index')
@section('title')
    ادارة الاطباء
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الاطباء</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الاطباء</li>
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
            <h3 class="card-title" style="float: right">قائمة الاطباء</h3>
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
                  {{-- @if($doctors->count() > 0) --}}
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الإسم
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        رقم الهاتف
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        مكان العمل(AM)
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الرتبة
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="">
                        الحالة
                      </th>
                      <th class="sorting align-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                        العملية
                      </th>
                    </tr>
                  {{-- @else
                    <div class="alert alert-danger notify-error">
                      {{ 'لم يتم اضافة اي دكتور' }}
                    </div>
                  @endif --}}
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @foreach ($doctors as $row)
                    <tr class="odd">
                      <td class="dtr-control" tabindex="0">{{$i++}}</td>
                      <td>{{$row->name}}</td>
                      <td class="sorting_1">{{$row->mobile_phone}}</td>
                      <td>{{$row->workplace_am}}</td>
                      <td>
                        @if ($row->rank == 1)
                            {{'A+'}}
                        @elseif($row->rank == 2)
                            {{'A'}}
                        @elseif($row->rank == 3)
                            {{'B+'}}
                        @elseif($row->rank == 4)
                            {{'B'}}
                        @elseif($row->rank == 5)
                            {{'C'}}
                        @elseif($row->rank == 6)
                            {{'Z'}}
                        @endif
                      </td>
                      <td>
                        @if ($row->statues)
                        <b class="text-success">{{'مفعل'}}</b>
                        @else
                        <b class="text-danger">{{'غير مفعل'}}</b>
                        @endif
                      </td>
                      <td>
                        <a href="/repScience/editDoctor/{{$row->id}}"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                        <a href="/repScience/showDoctorDetails/{{$row->id}}"><i class="fas fa-eye" title="تفاصيل اكثر"></i></a>
                        {{-- <i class="fas fa-eye"></i> --}}
                        {{-- <form action="/repScience/deleteDoctor/{{$row->id}}" method="post" style="float: right;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button style="border: none;margin-left: -10px;"><i class="fas fa-trash"></i></button>
                        </form> --}}
                        <input type="hidden" class="id" value="{{$row->id}}">
                        <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  <div>
                    <a href="{{url('/repScience/addDoctor')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة دكتور</a>
                  </div>
                  </tbody>
                  <tfoot>
                    {{-- @if($doctors->count() > 0) --}}
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">الاسم</th>
                        <th rowspan="1" colspan="1">رقم الهاتف</th>
                        <th rowspan="1" colspan="1">مكان العمل(AM)</th>
                        <th rowspan="1" colspan="1">الرتبة</th>
                        <th rowspan="1" colspan="1">الحالة</th>
                        <th rowspan="1" colspan="1">العملية</th>
                      </tr>
                    {{-- @endif --}}
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
                        url: '/repScience/deleteDoctor/'+id,
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