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
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/manageCategory">ادارة الاصناف</a></li>
                        <li class="breadcrumb-item active">مجموعة الاصناف</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل مجموعة الاصناف</h3>
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
                                <form method="POST" action="/admin/UpdateCategory/{{$category->id}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="card-body border">
                                        <div class="form-group col-md-6">
                                            <label for="name_cat">اسم المجموعة</label>
                                            <input type="text" value="{{ old('name_cat',$category->name_cat) }}" name="name_cat" class="form-control" id="name_cat">
                                            @if ($errors->has('name_cat'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('name_cat') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="company_id" class="control-label">اسم الشركة</label>
                                            <select name="company_id" id="company_id" class="form-control custom-select rounded-0">
                                                @foreach ($companies as $comp)
                                                    <option value="{{$comp->id}}" {{ old('company_id',$category->company_id) == $comp->id ? 'selected':'' }}>
                                                        {{$comp->name_company}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('company_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('company_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary font">
                                                تعديل <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                    </div><!-- /.card-body -->
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