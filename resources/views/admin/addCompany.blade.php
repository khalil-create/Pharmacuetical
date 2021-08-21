@extends('layouts.index')
@section('title')
    ادارة الشركات
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ادارة الشركات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/manageCompanies">ادارة الشركات</a></li>
                        <li class="breadcrumb-item active">الشركات</li>
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
                    <h3 class="card-title" style="float: right">إضافة شركة</h3>
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
                                <form method="POST" action="{{ url('admin/companyStore') }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body border">
                                        <div class="form-group col-md-6">
                                            <label for="name_company">اسم الشركة <span class="text-danger">*</span></label>
                                            <input type="text" name="name_company" value="{{ old('name_company') }}" class="form-control" id="name_company">
                                            @if ($errors->has('name_company'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('name_company') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="country_manufacturing">بلد التصنيع <span class="text-danger">*</span></label>
                                            <input type="text" name="country_manufacturing" value="{{ old('country_manufacturing') }}" class="form-control" id="country_manufacturing">
                                            @if ($errors->has('country_manufacturing'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('country_manufacturing') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label">المشرف عليها</label>
                                            <select name="supervisor_id" id="supervisor_id" class="form-control custom-select rounded-0">
                                                @foreach ($supervisor as $row)
                                                    <option value="{{$row->id}}" {{ old('supervisor_id') == $row->id ? 'selected':''}}>
                                                        {{ $row->user->user_name_third }} {{$row->user->user_surname}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('supervisor_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('supervisor_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>لديها مجموعة اصناف <span class="text-danger">*</span></label>
                                            <div class="radiobox">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1" name="have_category" checked>
                                                    <label class="form-check-label">نعم</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="have_category" value="0" {{ old('have_category') == 0 ? 'checked':''}}>
                                                    <label class="form-check-label">لا</label>
                                                </div>
                                            </div>
                                            @if ($errors->has('have_category'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('have_category') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="sign_img_company">تحميل شعار الشركة <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="sign_img_company">
                                                    <label class="custom-file-label" for="sign_img_company"></label>
                                                </div>
                                            </div>
                                            @if ($errors->has('sign_img_company'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('sign_img_company') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12" >
                                            <button type="submit" class="btn btn-primary font">
                                                حفظ<i class="fas fa-save"></i>
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