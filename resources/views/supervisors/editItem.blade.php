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
                    <li class="breadcrumb-item"><a href="/home">الصفحة الرئيسية</a></li>
                    <li class="breadcrumb-item active">الاصناف</li>
                </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content" >
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default" style="margin-left: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="float: right">تعديل الصنف</h3>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <form method="POST" action="/supervisor/itemUpdate/{{$item->id}}"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <div class="form-group">
                                        <label for="commercial_name">الاسم التجاري</label>
                                        <input type="text" value="{{$item->commercial_name}}" name="commercial_name" class="form-control" id="commercial_name">
                                        @if ($errors->has('commercial_name'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('commercial_name') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="science_name">الاسم العلمي</label>
                                        <input type="text" value="{{$item->science_name}}" name="science_name" class="form-control" id="science_name">
                                        @if ($errors->has('science_name'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('science_name') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('unit') ? ' has-error' : '' }}">
                                        <label for="unit" class="col-md-2 control-label">الوحده</label>
                                        <select name="unit" id="unit" class="form-control custom-select rounded-0">
                                            <option value="باكت"
                                                @if($item->unit == 'باكت')
                                                    {{'selected'}}
                                                @endif >باكت
                                            </option>
                                            <option value="شريط"
                                                @if($item->unit == 'شريط')
                                                    {{'selected'}}
                                                @endif >شريط
                                            </option>
                                            <option value="قارورة"
                                                @if($item->unit == 'قارورة')
                                                    {{'selected'}}
                                                @endif >قارورة
                                            </option>
                                        </select>
                                        @if ($errors->has('unit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('unit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="price">السعر</label>
                                        <input type="text" value="{{$item->price}}" name="price" class="form-control" id="price">
                                        @if ($errors->has('price'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('price') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="bonus">البونص ( % )</label>
                                        <input type="text" value="{{$item->bonus}}" name="bonus" class="form-control" id="bonus">
                                        @if ($errors->has('bonus'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('bonus') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    @if($specialists->count() > 0)
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">التخصصات المستهدفة للصنف <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من تخصص)</span></label>
                                            <select name="specialist_ids[]" class="form-control custom-select rounded-0" multiple>
                                                @foreach ($specialists as $specialist)
                                                    <option value="{{$specialist->id}}">{{$specialist->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @php
                                        $Yes = '';$No = '';$have_cat = true;
                                        if($item->companies->count() > 0){
                                            $No = 'checked';
                                            $have_cat = false;
                                        }
                                        else{
                                            $Yes = 'checked';
                                        }
                                    @endphp
                                    <div class="form-group">
                                        <label>لديه مجموعة اصناف</label>
                                        <div class="radiobox">
                                            <div class="form-check">
                                                <input onchange="haveCategory()" id="have_cat" class="form-check-input" type="radio" value="1" name="have_category" {{$Yes}}>
                                                <label class="form-check-label">نعم</label>
                                            </div>
                                            <div class="form-check">
                                                <input onchange="haveCategory()" id="have_not_cat" class="form-check-input" type="radio" name="have_category" value="0" {{$No}}>
                                                <label class="form-check-label">لا</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('have_category'))
                                            <span class="help-block">
                                                <small class="form-text text-danger">{{ $errors->first('have_category') }}</small>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group" id="category" @php if(!$have_cat) echo 'hidden'; @endphp>
                                        <label class="col-md-2 control-label">اسم المجموعة</label>
                                            <select name="category_id" id="category_id" class="form-control custom-select rounded-0">
                                                @foreach ($companies as $comp)
                                                    @foreach ($comp->categories as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->name_cat}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                    <div class="form-group" id="company" @php if($have_cat) echo 'hidden'; @endphp>
                                        @if($companies->where('have_category',0)->count() > 0)
                                            <input type="hidden" value="1" id="have_company">
                                            <label class="col-md- control-label">اسم الشركة <span class="text-danger" style="font-size: 9pt">(يمكنك اختيار اكثر من شركة)</span></label>
                                            <select name="company_ids[]" id="category_id" class="form-control custom-select rounded-0" multiple>
                                                    @foreach ($companies->where('have_category',0) as $comp)
                                                        <option value="{{$comp->id}}">{{$comp->name_company}}</option>
                                                    @endforeach
                                            </select>
                                            @if ($errors->has('company_ids'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('company_ids') }}</strong>
                                                </span>
                                            @endif
                                        @else
                                            <input type="hidden" value="0" id="have_company">
                                            <div  class="alert alert-danger notify-error">لاتوجد شركات ليس لديها مجموعة اصناف اذا اردت اضافة هذا الصنف وليس لديه مجموعة اصناف فـ عليك اولا بإضافة هذه الشركة</div>
                                        @endif
                                    </div>
                                    <div class="form-group" >
                                        <button type="submit" class="btn btn-primary font" style="margin-top: 10px;">
                                            تعديل <i class="fas fa-edit"></i>
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