@extends('layouts.admin')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Trang quản trị {{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
    </head>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Viết comment</h3>
    </div>
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Tên sản phẩm: {!! $product->name !!}</h4>
                    <form class="forms-sample" method="post" action="{{ route('admin.products.comments.store', $product->id) }}">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea class="form-control" name="content" id="content"
                                      placeholder="Comment đi ai cắm bạn vui cơ chứ" row="6">{{ old('content') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Lưu lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
