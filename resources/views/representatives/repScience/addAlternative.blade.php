@extends('layouts.index')
@section('title')
    ادارة بدائل الأصناف
@endsection

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header content-wrapper">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6" >
                <h1 class="m-0">ادارة بدائل الأصناف</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                <li class="breadcrumb-item active">بدائل الأصناف</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

<!-- /.content-header -->
<div>
    <section class="content" >
            <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                <h3 class="card-title" style="float: right">إضافة بديل</h3>
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
                @if (session('error'))
                    <div class="alert alert-danger notify-error">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                    <div class="form-group">
                        <form method="POST" action="/repScience/storeAlternative"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>الاسم التجاري</label>
                                <input type="text" name="commercial_name" class="form-control">
                                @if ($errors->has('commercial_name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('commercial_name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>اسم الوكالة</label>
                                <input type="text" name="agency_name" class="form-control">
                                @if ($errors->has('agency_name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('agency_name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>اسم الشركة</label>
                                <input type="text" name="company_name" class="form-control">
                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('company_name') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>بلد التصنيع</label>
                                <input type="text" name="country_manufacturing" class="form-control">
                                @if ($errors->has('country_manufacturing'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('country_manufacturing') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>الوحدة</label>
                                    <select name="unit" class="custom-select rounded-0">
                                        <option value="باكت">
                                            باكت
                                        </option>
                                    </select>
                                    @if ($errors->has('unit'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('unit') }}</small>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label>العبوة</label>
                                <input type="text" name="refill" class="form-control">
                                @if ($errors->has('refill'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('refill') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>السعر</label>
                                <input type="text" name="price" class="form-control">
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>البونص</label>
                                <input type="text" name="bonus" class="form-control">
                                @if ($errors->has('bonus'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="newTool">وسائل الترويج المستخدمة</label>
                                    {{-- <div class="form-inline">
                                        <div class="input-group">
                                            <input id="newTool"  placeholder="اضافة وسيلة أخرى" autocomplete="off">
                                            <div>
                                                <button id="btnAdd">
                                                <i class="fas fa-plus fa-fw"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <select id="list" name="promotion_materials[]" class="custom-select rounded-0" multiple>
                                        <option value="عينات">
                                            عينات
                                        </option>
                                        <option value="خدمات">
                                            خدمات
                                        </option>
                                        <option value="لقاءات علمية">
                                            لقاءات علمية
                                        </option>
                                        <option value="بونص اضافي">
                                            بونص اضافي
                                        </option>
                                    </select>
                                    @if ($errors->has('promotion_materials'))
                                        <span class="help-block">
                                            <small class="form-text text-danger">{{ $errors->first('promotion_materials') }}</small>
                                        </span>
                                    @endif
                            </div>
                            {{-- <script>
                                const btnAdd = document.querySelector('#btnAdd');
                                const list = document.querySelector('#list');
                                const new = document.querySelector('#newTool');

                                btnAdd.onclick = (e) => {
                                    e.preventDefault();
                                    if(new.value == ''){
                                        alert('قم بإدخال العنصر اولا')ك
                                        return;
                                    }
                                    const option = new Option(new.value,new.value);
                                    list.add(option,undefined);
                                    new.value = '';
                                };
                            </script> --}}
                            <div class="form-group">
                                <label>تأريخ النزول للسوق</label>
                                <input type="date" class="form-control" name="date">
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <small class="form-text text-danger">{{ $errors->first('date') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" >
                                <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                    حفظ<i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                        </div>
                        <!-- /.form-group -->
                    </form>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
                the plugin.
                </div>
            </div>
            <!-- /.card -->
            </div>
        <!-- /.container-fluid -->
    </section>
</div>
</div>
@endsection
@section('scripts')
    
@endsection