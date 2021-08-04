@extends('layouts.index')
@section('title')
    ادارة الاصناف 
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الاصناف</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الاصناف</li>
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
            <span class="card-title" style="float: right">قائمة الاصناف</span>
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
            <div id="error" hidden>
                <div  class="alert alert-danger notify-error">
                {{'لم يتم اضافة اي صنف'}}
                </div>
                <div>
                  <a href="{{url('/supervisor/itemAdd/1')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة صنف</a>
                </div>
            </div>
            <div class="row">
              <div id="table" class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if($companies->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الاسم التجاري
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الاسم العلمي
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        السعر
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        البونص
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الوحدة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        اسم المجموعة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-error">
                      {{ 'لم يتم اضافة اي صنف' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1;$haveItem = false?>
                  @foreach ($companies as $comp)
                    @foreach ($comp->categories as $cat)
                      @foreach ($cat->items as $row)
                          @php
                            if($row->count() > 0)$haveItem = true;
                        @endphp
                        <tr class="odd">
                          <td class="dtr-control" tabindex="0">{{$i++}}</td>
                          <td>{{$row->commercial_name}}</td>
                          <td>{{$row->science_name}}</td>
                          <td>{{$row->price}}</td>
                          <td class="sorting_1">{{$row->bonus}}</td>
                          <td class="sorting_1">{{$row->unit}}</td>
                          <td class="sorting_1">{{$cat->name_cat}}</td>
                          <td>
                            <a href="/supervisor/itemEdit/{{$row->id}}"><i class="nav-icon fas fa-edit kkk" title="تعديل"></i></a>
                            <a href="/supervisor/itemUses/{{$row->id}}"><i class="fas fa-info" title="الاستخدامات"></i></a>
                            {{-- <form action="/supervisor/itemDelete/{{$row->id}}" method="post" style="float: right;">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button style="border: none;margin-left: -15px;"><i class="fas fa-trash"></i></button>
                              </form> --}}
                              <input type="hidden" class="id" value="{{$row->id}}">
                            <a type="button"><i class="fas fa-trash DeleteBtn"></i></a>
                            <a href="/supervisor/showDetails/{{$row->id}}"><i class="fas fa-eye" title="التفاصيل"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    @endforeach
                  @endforeach
                  <div>
                    <a href="{{url('/supervisor/itemAdd/1')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة صنف</a>
                  </div>
                  </tbody>
                  <tfoot>
                    @if($companies->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">الاسم التجاري</th>
                        <th rowspan="1" colspan="1">الاسم العلمي</th>
                        <th rowspan="1" colspan="1">السعر</th>
                        <th rowspan="1" colspan="1">البونص</th>
                        <th rowspan="1" colspan="1">الوحدة</th>
                        <th rowspan="1" colspan="1">اسم المجموعة</th>
                        <th rowspan="1" colspan="1" style="">العملية</th>
                      </tr>
                    @endif
                  </tfoot>
                </table>
                @if ($haveItem)
                    <input id="haveItem" value="1" hidden>
                @else
                  <input id="haveItem" value="0" hidden>
                @endif
              </div>
              <script>
                var haveItem = document.getElementById("haveItem");
                var table = document.getElementById("table");
                var error = document.getElementById("error");
                if(haveItem.value == 0){
                  table.hidden = true;
                  error.hidden = false;
                }
              </script>
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
                        url: '/supervisor/itemDelete/'+id,
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


{{-- 
  
  @extends('layouts.index')
@section('title')
    ادارة الاصناف 
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
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
            <span class="card-title" style="float: right">قائمة الاصناف</span>
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
              <div id="table" class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  @if($companies->count() > 0)
                    <tr role="row">
                      <th class="sorting number" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                        #
                      </th>
                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                        الاسم التجاري
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الاسم العلمي
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        السعر
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        البونص
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        الوحدة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        اسم المجموعة
                      </th>
                      <th class="sorting sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" aria-sort="descending">
                        العملية
                      </th>
                    </tr>
                  @else
                    <div class="alert alert-danger notify-error">
                      {{ 'لم يتم اضافة اي صنف' }}
                    </div>
                  @endif
                  </thead>
                  <tbody>
                  <?php $i=1;$haveItem = false?>
                  @foreach ($companies as $comp)
                      @if ($comp->haveCategory == 1)
                        @foreach ($comp->categories as $cat)
                          @foreach ($cat->items as $item)
                          @php
                              if($item->count() > 0)$haveItem = true;
                          @endphp
                          <tr class="odd">
                            <td class="dtr-control" tabindex="0">{{$i++}}</td>
                            <td>{{$item->commercial_name}}</td>
                            <td>{{$item->science_name}}</td>
                            <td>{{$item->price}}</td>
                            <td class="sorting_1">{{$item->bonus}}</td>
                            <td class="sorting_1">{{$item->unit}}</td>
                            <td class="sorting_1">{{$item->category->name_cat}}</td>
                            <td class="" style="">
                              <a href="/supervisor/itemEdit/{{$item->id}}"><i class="nav-icon fas fa-edit kkk" title="تعديل"></i></a>
                              <a href="/supervisor/itemUses/{{$item->id}}"><i class="fas fa-info" title="الاستخدامات"></i></a>
                              <form action="/supervisor/itemDelete/{{$item->id}}" method="post" style="float: right;">
                                  {{csrf_field()}}
                                  {{method_field('DELETE')}}
                                  <button style="border: none;margin-left: -15px;"><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="/supervisor/showDetails/{{$item->id}}"><i class="fas fa-eye" title="التفاصيل"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        @endforeach
                      @else
                        @foreach($comp->items as $item)
                        @php
                              if($item->count() > 0)$haveItem = true;
                        @endphp
                        <tr class="odd">
                          <td class="dtr-control" tabindex="0">{{$i++}}</td>
                          <td>{{$item->commercial_name}}</td>
                          <td>{{$item->science_name}}</td>
                          <td>{{$item->price}}</td>
                          <td class="sorting_1">{{$item->bonus}}</td>
                          <td class="sorting_1">{{$item->unit}}</td>
                          <td class="sorting_1">{{'لاتوجد'}}</td>
                          <td class="" style="">
                            <a href="/supervisor/itemEdit/{{$item->id}}"><i class="nav-icon fas fa-edit kkk" title="تعديل"></i></a>
                            <a href="/supervisor/itemUses/{{$item->id}}"><i class="fas fa-info" title="الاستخدامات"></i></a>
                            <form action="/supervisor/itemDelete/{{$item->id}}" method="post" style="float: right;">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button style="border: none;margin-left: -15px;"><i class="fas fa-trash"></i></button>
                              </form>
                              <a href="/supervisor/showDetails/{{$item->id}}"><i class="fas fa-eye" title="التفاصيل"></i></a>
                          </td>
                        </tr>
                        @endforeach
                      @endif
                  @endforeach
                  <div>
                    <a href="{{url('/supervisor/itemAdd')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة صنف</a>
                        @if (session('status'))
                            <div class="alert alert-success notify-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                                  <div class="alert alert-danger notify-error">
                                      {{ session('error') }}
                                  </div>
                        @endif
                  </div>
                  </tbody>
                  <tfoot>
                    @if($companies->count() > 0)
                      <tr>
                        <th rowspan="1" colspan="1">#</th>
                        <th rowspan="1" colspan="1">الاسم التجاري</th>
                        <th rowspan="1" colspan="1">الاسم العلمي</th>
                        <th rowspan="1" colspan="1">السعر</th>
                        <th rowspan="1" colspan="1">البونص</th>
                        <th rowspan="1" colspan="1">الوحدة</th>
                        <th rowspan="1" colspan="1">اسم المجموعة</th>
                        <th rowspan="1" colspan="1" style="">العملية</th>
                      </tr>
                    @endif
                  </tfoot>
                </table>
                @if ($haveItem)
                    <input id="haveItem" value="1" hidden>
                @else
                  <input id="haveItem" value="0" hidden>
                @endif
                
              </div>
              <div id="error" hidden>
                <div  class="alert alert-danger notify-error" >
                {{'لم يتم اضافة اي صنف'}}
                </div>
                <div>
                  <a href="{{url('/supervisor/itemAdd')}}" class="btn btn-primary add"><i class="fas fa-plus"></i> اضافة صنف</a>
                </div>
              </div>
              <script>
                var haveItem = document.getElementById("haveItem");
                var table = document.getElementById("table");
                var error = document.getElementById("error");
                if(haveItem.value == 0){
                  table.hidden = true;
                  error.hidden = false;
                }
              </script>
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


  --}}
