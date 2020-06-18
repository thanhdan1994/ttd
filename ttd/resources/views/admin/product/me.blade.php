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
    <div class="row">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="col-12 col-md-4 col-lg-3 col-xl-3">
                    <img class="img-fluid img-thumbnail" src="{!! $product->thumbnailUrl !!}" alt="image" style="max-width:100%">
                    <div class="card-body">
                        <h4 class="card-title">{!! $product->name !!}</h4>
                        <p class="card-text">{!! $product->excerpt !!}</p>
                        <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 alert alert-warning alert-dismissible fade show" role="alert">
                <strong>How are you felling today!</strong> You haven't any bookmarks products.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
@endsection
