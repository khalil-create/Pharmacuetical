@extends('layouts.index')
@section('title')
    الصفحة الرئيسية
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">الصفحة الرئيسية</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        مندوب مبيعات
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
