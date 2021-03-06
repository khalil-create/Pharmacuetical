@extends('layouts.index')
@section('title')
    ادارة الاصناف
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ادارة الاصناف</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
<<<<<<< HEAD
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/supervisor/manageRepItems">ادارة اصناف المندوبين</a></li>
                        <li class="breadcrumb-item active">اصناف المندوبين</li>
                    </ol>
=======
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/supervisor/manageRepItems">ادارة اصناف المندوبين</a></li>
                    <li class="breadcrumb-item active">اصناف المندوبين</li>
                </ol>
>>>>>>> 4bc6d0e5719fbdf8d90c9dc20f8daaa499dc4193
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تحديد اصناف للمندوبـ/ـة :- 
                        <span class="text-bold">{{$rep->user->user_name_third}} {{$rep->user->user_surname}}</span>
                    </h3>
                    <div class="card-tools float-right">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div><!-- /.card-header -->   
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <form method="POST" action="/supervisor/updateRepItems/{{$rep->id}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="form-group">
                                        <label class="col-md-8 control-label">الاصناف<span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من صنف)</span></label>
                                        <select name="items_ids[]" class="form-control custom-select rounded-0" multiple>
                                            @foreach ($companies as $comp)
                                                @if ($comp->have_category == 1)
                                                    @foreach ($comp->categories as $cat)
                                                        @foreach ($cat->items as $item)
                                                            <option value="{{$item->id}}">{{$item->commercial_name}}</option>
                                                        @endforeach
                                                    @endforeach
                                                @else
                                                    @foreach ($comp->items as $item)
                                                        <option value="{{$item->id}}">{{$item->commercial_name}}</option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('items_ids'))
                                            <span class="help-block">
                                                <small class="text-sm text-danger">{{ $errors->first('items_ids') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group" >
                                        <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                            حفظ <i class="fas fa-save"></i>
                                        </button>
                                    </div>
                                </form><!-- /.form -->
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="card-footer">
    Footer
    </div>
</div><!-- /.content-header -->
@endsection
@section('scripts')

@endsection