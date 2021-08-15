@extends('layouts.index')
@section('title')
    ادارة الاختبارات
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الاختبارات</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">نتائج الاختبارات</li>
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
              قائمة نتائج المندوبيين في <span class="text-bold">{{$test->test_name}}</span>
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
                  @if($test->testResults->whereNotNull('result')->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        المندوب
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الدرجة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم امتحان المندوبيين لهذا الاختبار، اما انه لم يتم تحديد المندوبيين او ان المندوبيين لم يمتحنوا' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                    <?php $i=1?>
                    @foreach ($test->representatives as $row)
                      @if($row->repResults->where('test_id',$test->id)->first()->result != null)
                        <tr class="odd">
                          <td class="dtr-control" tabindex="0">{{$i++}}</td>
                          <td>
                            <img src="{{asset('images/users/'.$row->user->user_image)}}" class="img-users">
                            {{$row->user->user_name_third}} {{$row->user->user_surname}}
                          </td>
                          <td>
                            @php $results_arr = explode('+',$row->repResults->first()->result);$try = 1; @endphp
                            @foreach ($results_arr as $result)
                                {{'المحاولة ('.$try.') : '.$result}}%<br>
                                @php $try++; @endphp
                            @endforeach
                          </td>
                          <td>
                            <input type="hidden" class="test_id" value="{{$test->id}}">
                            <input type="hidden" class="rep_id" value="{{$row->id}}">
                            <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                          </td>
                        </tr>
                      @endif
                    @endforeach
                  </tbody>
                  <tfoot>
                    @if($test->testResults->whereNotNull('result')->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1" style="">المندوب</th>
                        <th rowspan="1" colspan="1" style="">الدرجة</th>
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
            var rep_id = $(this).closest("tr").find('.rep_id').val();
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
                        "rep_id": rep_id,
                        "test_id": test_id,
                    };
                    $.ajax({
                        type: "DELETE",
                        url: '/supervisor/deleteTestRep',
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