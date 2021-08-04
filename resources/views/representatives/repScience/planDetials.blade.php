@extends('layouts.index')
@section('title')
    ادارة الخطط
@endsection
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الخطط</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الخطط</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  <!-- /.content-header -->
  <div class="content">
    <div class="container-fluid">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title" style="float: right">اضافة بيانات الخطة لشهر {{$plan->plan_month}}</h3>
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
          <div class="form-group">
            <form method="POST" action="/repScience/storePlanCustomer/{{$plan->id}}"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
              <div class="form-group">
                <div class="khalil">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">اضافة خطة جديدة</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">تأريخ الزيارة</label>
                                <input type="date" class="form-control" name="date">
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('date') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                              <label for="date">العميل</label>
                              <select name="customer_name" class="form-control custom-select rounded-0">
                                  @foreach($customers as $row)
                                  <option value="{{$row->name}}">
                                    {{$row->name}}
                                  </option>
                                  @endforeach
                                  @foreach($doctors as $row)
                                  <option value="{{$row->name}}">
                                    {{'د. '.$row->name}}
                                  </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="date">الفترة</label>
                              <select name="period" class="form-control custom-select rounded-0">
                                  <option value="AM">صباحية</option>
                                  <option value="PM">مسائية</option>
                              </select>
                            </div>
                            <div class="cform-group">
                              <label for="date">ملاحظه</label>
                                <textarea name="note" id="form" rows="1" class="form-control"></textarea>
                                <small id="invalidOwnerNo" class="form-text text-danger"></small>
                                @if ($errors->has('owner_tel'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('owner_tel') }}</small>
                                    </span>
                                @endif
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group" >
                            <button type="submit" class="btn btn-primary font" style="margin: 10px 6px -19px;">
                                حفظ<i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    <!-- /.card-body -->
                </div>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title" style="float: right">عرض بيانات الخطة لشهر {{$plan->plan_month}}</h3>
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
            @if($plan->customers_all->count() > 0)
              <tr role="row">
                <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                  #
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                  تأريخ الزيارة
                </th> 
                <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                  الفترة
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                  العميل
                </th>
                <th class="sorting align-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="">
                  العملية
                </th>
              </tr>
            @else
              <div class="alert alert-danger notify-error">
                {{ 'لم يتم اضافة اي خطة' }}
              </div>
            @endif
            </thead>
            <tbody>
            <?php $i=1?>
            @foreach ($plan->customers_all as $row)
              <tr class="odd">
                <td class="dtr-control" tabindex="0">{{$i++}}</td>
                <td>{{$row->visit_date}}</td>
                <td>{{$row->period}}</td>
                <td>
                  @if ($row->customer)
                      {{$row->customer->name}}
                  @else
                      {{$row->doctor->name}}
                  @endif
                </td>
                <td>
                  <a href="/repScience/editPlanCustomer/{{$row->id}}" style="float: right;"><i class="nav-icon fas fa-edit" title="تعديل"></i></a>
                  {{-- <form action="/repScience/deletePlanCustomer/{{$row->id}}" method="post" style="float: right;">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button style="border: none;"><i class="fas fa-trash"></i></button>
                  </form> --}}
                  <input type="hidden" class="id" value="{{$row->id}}">
                  <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              @if($plan->customers_all->count() > 0)
                <tr>
                  <th rowspan="1" colspan="1">#</th>
                  <th rowspan="1" colspan="1">تأريخ الزيارة</th>
                  <th rowspan="1" colspan="1">الفترة</th>
                  <th rowspan="1" colspan="1">العميل</th>
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
                        url: '/repScience/deletePlanCustomer/'+id,
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