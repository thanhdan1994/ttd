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
    <div class="row" id="js-append-products">
        @foreach($bookmarks as $bookmark)
            <div class="col-12 col-md-4 col-lg-3 col-xl-3">
                <img class="img-fluid img-thumbnail" src="{!! $bookmark->product->thumbnailUrl !!}" alt="image" style="max-width:100%">
                <div class="card-body">
                    <h4 class="card-title">{!! $bookmark->product->name !!}</h4>
                    <p class="card-text">{!! $bookmark->product->excerpt !!}</p>
                    <a href="{{ route('admin.products.show', $bookmark->product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
