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
                        <li class="breadcrumb-item"><a href="/admin/manageItem">ادارة الاصناف</a></li>
                        <li class="breadcrumb-item active">الاصناف</li>
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
                    <h3 class="card-title" style="float: right">إضافة صنف</h3>
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
                                <form method="POST" action="{{ url('admin/itemStore') }}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="card-body border">
                                        <div class="form-group col-md-6">
                                            <label for="commercial_name">الاسم التجاري <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('commercial_name') }}" name="commercial_name" class="form-control" id="commercial_name">
                                            @if ($errors->has('commercial_name'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('commercial_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="science_name">الاسم العلمي <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('science_name') }}" name="science_name" class="form-control" id="science_name">
                                            @if ($errors->has('science_name'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('science_name') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="unit" class="control-label">وحدة البيع <span class="text-danger">*</span></label>
                                            <select name="unit" id="unit" class="form-control custom-select rounded-0">
                                                    <option value="باكت" {{ old('') }}>
                                                        باكت</option>
                                                    <option value="شريط">شريط</option>
                                                    <option value="قارورة">قارورة</option>
                                            </select>
                                            @if ($errors->has('unit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('unit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="price">السعر <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('price') }}" name="price" class="form-control" id="price">
                                            @if ($errors->has('price'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bonus">البونص ( % ) <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ old('bonus') }}" name="bonus" class="form-control" id="bonus">
                                            @if ($errors->has('bonus'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        @if($specialists)
                                            <div class="form-group col-md-6">
                                                <label class="control-label">التخصصات المستهدفة للصنف <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من تخصص)</span></label>
                                                <select name="specialist_ids[]" class="form-control custom-select rounded-0" multiple>
                                                    @foreach ($specialists as $specialist)
                                                        <option value="{{$specialist->id}}" {{ old('specialist_ids') == $specialist->id ? 'selected':'' }}>{{$specialist->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('specialist_ids'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('specialist_ids') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="form-group col-md-6">
                                            <label>لديه مجموعة اصناف</label>
                                            <div class="radiobox">
                                                <div class="form-check">
                                                    <input onchange="haveCategory()" id="have_cat" class="form-check-input" type="radio" value="1" name="have_category" checked>
                                                    <label class="form-check-label">نعم</label>
                                                </div>
                                                <div class="form-check">
                                                    <input onchange="haveCategory()" id="have_not_cat" class="form-check-input" type="radio" name="have_category" value="0" {{ old('have_category') == 0 ? 'checked':''}}>
                                                    <label class="form-check-label">لا</label>
                                                </div>
                                            </div>
                                            @if ($errors->has('have_category'))
                                                <span class="help-block">
                                                    <small class="form-text text-danger">{{ $errors->first('have_category') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-6" id="category" {{ old('have_category') == 0 ? 'hidden':''}}>
                                            <label class="control-label">اسم المجموعة</label>
                                                <select name="category_id" id="category_id" class="form-control custom-select rounded-0">
                                                    @foreach ($companies as $comp)
                                                        @foreach ($comp->categories as $cat)
                                                            <option value="{{$cat->id}}" {{ old('category_id') == $cat->id ? 'selected':'' }}>
                                                                {{$cat->name_cat}}
                                                            </option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('category_id'))
                                                    <span class="help-block">
                                                        <small class="text-sm text-danger">{{ $errors->first('category_id') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        <div class="form-group col-md-6" id="company" {{ old('have_category') == 1 ? 'hidden':''}}>
                                            @if($companies->where('have_category',0)->count() > 0)
                                                <input type="hidden" value="1" id="have_company">
                                                <label class="control-label">اسم الشركة <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من شركة)</span></label>
                                                <select name="company_ids[]" id="category_id" class="form-control custom-select rounded-0" multiple>
                                                        @foreach ($companies->where('have_category',0) as $comp)
                                                            <option value="{{$comp->id}}" {{ old('company_ids') == $comp->id ? 'selected':'' }}>
                                                                {{$comp->name_company}}
                                                            </option>
                                                        @endforeach
                                                </select>
                                                @if ($errors->has('company_ids'))
                                                    <span class="help-block">
                                                        <small class="text-sm text-danger">{{ $errors->first('company_ids') }}</small>
                                                    </span>
                                                @endif
                                            @else
                                                <input type="hidden" value="0" id="have_company">
                                                <div  class="alert alert-danger notify-error">لاتوجد شركات ليس لديها مجموعة اصناف اذا اردت اضافة هذا الصنف وليس لديه مجموعة اصناف فـ عليك اولا بإضافة هذه الشركة</div>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
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
@section('scripts')

@endsection