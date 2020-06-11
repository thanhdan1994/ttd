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
    </div>
@endsection

@section('js')
    <script>
        function getProductsByLocation(callbackFunction) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(callbackFunction)
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
        function initialProducts(position) {
            $.ajax({
                url: "/api/get-products-nearby",
                type: "GET",
                data: {'lat': position.coords.latitude , 'long': position.coords.longitude, 'page': 1},
                success: function (products) {
                    let listProducts = '';
                    $.each(products, function (key, product) {
                        listProducts += `<div class="col-12 col-md-4 col-lg-3 col-xl-3">
                              <img class="img-fluid img-thumbnail" src="${product.thumbnail}" alt="image" style="max-width:100%">
                              <div class="card-body">
                                <h4 class="card-title">${product.name}</h4>
                                <p class="card-text">${product.excerpt}</p>
                                <a href="javascript:void(0)" class="btn btn-primary">Xem chi tiết</a>
                              </div>
                            </div>`
                    });
                    $('#js-append-products').append(listProducts);
                }
            })
        }
        getProductsByLocation(initialProducts);
    </script>
@endsection
