@extends('layouts.index')
@section('title')
    ادارة الاسئلة
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الاسئلة</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">اسئلة الاختيار</li>
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
              قائمة الأسئلة
              <span class="bold">{{$test->test_name}}
                (
                  @if ($type == 0)
                      {{' صواب/خطأ '}}
                  @else
                      {{' اختيار متعدد '}}
                  @endif
                )
              </span>
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
                  @if($questions->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        السؤال
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الاختيارات
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الاجابة الصحيحة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم اضافة اي سؤال لهذا الاختبار' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1?>
                  @if($questions->count() > 0)
                    @foreach ($questions as $row)
                      <tr class="odd">
                        <td class="dtr-control" tabindex="0">{{$i++}}</td>
                        <td class="text-right">{{$row->question}}</td>
                        <td class="text-right">
                          @if ($type == 0)
                              {{'صواب/خطأ'}}
                          @else
                              @php
                                  $choices = $row->choices;
                                  $choices_arr = explode("++",$choices);
                                  $no = 0;
                              @endphp
                              @foreach ($choices_arr as $r)
                                  {{++$no.'- '}}
                                  @if ($r == $row->right_answer)
                                      <b class="text-success">{{$r}}</b>
                                  @else
                                      {{$r}}
                                  @endif
                                  <br>
                              @endforeach
                          @endif
                        </td>
                        <td class="text-right text-success"><b>{{$row->right_answer}}</b></td>
                        <td>
                          <a href="{{route('editQuestion',['id' => $row->id,'type' => $type,'test_id' => $test->id])}}"><i class="nav-icon fas fa-edit kkk" title="تعديل"></i></a>
                          {{-- <form action="{{route('deleteQuestion',['id' => $row->id,'type' => $type,'test_id' => $test->id])}}" method="post" style="float: right;">
                              {{csrf_field()}}
                              {{method_field('DELETE')}}
                              <button style="border: none;margin-left: -15px;"><i class="fas fa-trash" title="حذف"></i></button>
                          </form> --}}
                          <input type="hidden" class="id" value="{{$row->id}}">
                          <input type="hidden" class="type" value="{{$type}}">
                          <input type="hidden" class="test_id" value="{{$test->id}}">
                          <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                          {{-- <a href="/supervisor/showDetails/{{$row->id}}"><i class="fas fa-eye" title="التفاصيل"></i></a> --}}
                        </td>
                      </tr>
                    @endforeach
                  @endif
                  <div>
                    {{-- <a href="/supervisor/addQuestion/{{$test->id}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة سؤال</a> --}}
                    <a href="{{route('addQuestion',['id' => $test->id,'type' => $type])}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة سؤال</a>
                  </div>
                  </tbody>
                  <tfoot>
                    @if($questions->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1" style="">السؤال</th>
                        <th rowspan="1" colspan="1" style="">الاختيارات</th>
                        <th rowspan="1" colspan="1" style="">الاجابة الصحيحة</th>
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
            var type = $(this).closest("tr").find('.type').val();
            var test_id = $(this).closest("tr").find('.test_id').val();
            
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
                        "type": type,
                        "test_id": test_id,
                    };
                    $.ajax({
                        type: "DELETE",
                        url: '/supervisor/deleteQuestion',
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