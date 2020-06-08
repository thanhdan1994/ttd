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
        <link rel="stylesheet" href="{{asset('admin/assets/css/jquery.fancybox.min.css')}}" />
    </head>
    <style>
        /* CSS Test begin */
        .comment-box {
            margin-top: 30px !important;
        }
        /* CSS Test end */

        .comment-box img {
            width: 50px;
            height: 50px;
        }
        .comment-box .media-left {
            padding-right: 10px;
            width: 65px;
        }
        .comment-box .media-body p {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .comment-box .media-body .media p {
            margin-bottom: 0;
        }
        .comment-box .media-heading {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 7px 10px;
            position: relative;
            margin-bottom: -1px;
        }
        .comment-box .media-heading:before {
            content: "";
            width: 12px;
            height: 12px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-width: 1px 0 0 1px;
            -webkit-transform: rotate(-45deg);
            transform: rotate(-45deg);
            position: absolute;
            top: 10px;
            left: -6px;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">#{!! $product->id !!}</h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#info">Thông tin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#images">Ảnh chi tiết</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#content">Nội dung bài</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#reports">Reports</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane container active" id="info">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                    <img class="mw-100" src="{!! $product->thumbnailUrl !!}">
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-8 col-xl-8 d-flex flex-column">
                    <h4>{!! $product->name !!}</h4>
                    <span class="text-danger font-weight-bold h5">Giá: {!! number_format($product->amount) !!}đ</span>
                    <span class="text-danger font-weight-bold h5">Số điện thoại: {!! $product->phone !!}</span>
                    <span class="text-danger font-weight-bold h5">Địa chỉ: {!! $product->address !!}</span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <table class="table table-dark">
                        <tbody>
                        @foreach(json_decode($product->properties) as $key => $property)
                            <tr>
                                <th scope="row">{{$property->key}}</th>
                                <td>{{$property->value}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane container fade" id="images">
            @foreach ($product->images as $image)
                <a class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4" data-fancybox="gallery"
                   href="{!! $image->getUrl() !!}">
                    <img style="width: 200px; height: 150px" src="{!! $image->getUrl('thumb') !!}">
                </a>
            @endforeach
        </div>
        <div class="tab-pane container fade" id="content">{!! $product->content !!}</div>
        <div class="tab-pane container fade" id="reports">
            @foreach($product->reports as $report)
            <div class="media mb-3">
                <img class="mr-3" src="{!! $report->user->thumbnailUrl !!}" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">{!! $report->user->name !!}</h5>
                    {!! $report->excerpt !!}
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach(json_decode($report->properties) as $key => $property)
                                <th scope="col">{{$property->key}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach(json_decode($report->properties) as $key => $property)
                                <td>{{$property->value}}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportModal{!! $report->id !!}">
                        Ảnh report
                    </button>
                    <div class="modal fade" id="reportModal{!! $report->id !!}">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">#{!! $report->id !!}</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        @foreach ($report->images as $image)
                                        <a class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3" data-fancybox="galleryReport{!! $report->id !!}"
                                           href="{!! $image->getUrl() !!}">
                                            <img style="width: 250px; height: 200px" src="{!! $image->getUrl('thumb') !!}">
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div id="block-comments" class="row mt-5">
        <div class="col-12">
            <h2>Bình luận</h2>
            @foreach($product->comments as $comment)
            <div class="media comment-box">
                <div class="media-left">
                    <img class="img-responsive user-photo" src="{!! $comment->user->thumbnailUrl !!}">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{!! $comment->user->name !!}</h4>
                    <p>{!! $comment->content !!}</p>
                    @foreach($comment->child as $commentChild)
                    <div class="media">
                        <div class="media-left">
                            <img class="img-responsive user-photo" src="{!! $commentChild->user->thumbnailUrl !!}">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{!! $commentChild->user->name !!}</h4>
                            <p>{!! $commentChild->content !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection
