@extends('layouts.index')
@section('title')
      ادارة الاهداف البيعية
@endsection
@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
  <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ادارة الاهداف البيعية</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
            <li class="breadcrumb-item active">الاهداف البيعية</li>
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
              توزيع الهدف البيعي  (<b>{{$salesObjective->objective}}</b>)
              للصنف (<b>{{$salesObjective->item->commercial_name}}</b>) على المشرفين
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
            <div class="row col-14">
              <form style="width: 100%" method="POST" action="/managerMarketing/storeDistributedSalesObjForSup" onsubmit="return ValidationDistributed()" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="col-sm-12">
                  @if($supervisors->count() > 0)
                    <table class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                      <thead style="background-color: #8eaab1;">
                        <tr role="row">
                          <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                            المشرف
                          </th>
                          <th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                            الهدف
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <input name="item_id" value="{{$salesObjective->item_id}}" hidden>
                        <input id="total_objective" value="{{$salesObjective->objective}}" hidden>
                        @foreach ($supervisors as $row)
                        <tr>
                          <td>
                            <input name="supervisor[]" value="{{$row->id}}" hidden>
                            <label style="float: right">{{$row->user->user_name_third}} {{$row->user->user_surname}}</label>
                          </td>
                          <td>
                            @php $found = false; @endphp
                            @foreach($sales as $obj)
                                @if($obj->supervisor_id == $row->id)
                                    @php $found = true; @endphp
                                    <input value="{{$obj->objective}}" type="text" placeholder="الهدف البيعي لهذا المشرف" name="objective[]" class="form-control">
                                    @break
                                @endif
                            @endforeach
                            @if(!$found)
                              <input type="text" placeholder="مقدار الهدف لهذا المشرف" name="objective[]" class="form-control">
                            @endif
                            @if ($errors->has('objective'))
                              <span class="help-block">
                                  <small class="form-text text-danger">{{ $errors->first('objective') }}</small>
                              </span>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        <tr rowspan="2">
                          <label>الوصف</label>
                          <input  name="description" value="{{$salesObjective->description}}" type="text" placeholder="اضافة وصف للهدف البيعي" class="form-control">
                        </tr>
                      </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary font" style="margin: 10px">
                      توزيع 
                    </button>
                  @else
                    <div class="alert alert-danger notify-danger">
                      {{ 'لم يتم اضافة اي مشرف' }}
                    </div>
                  @endif
                </div>
              </form>
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
