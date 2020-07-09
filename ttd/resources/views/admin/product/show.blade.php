@extends('layouts.admin')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .comment-box .box-reply {
            margin: 0 10%;
        }
        .js-show-box-reply-comment:hover {
            cursor: pointer;
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
        <div class="tab-pane active" id="info">
            <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-2">
                    <img class="mw-100" src="{!! $product->thumbnailUrl !!}">
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-8 col-xl-10 d-flex flex-column">
                    <h4>{!! $product->name !!}</h4>
                    <span class="text-danger font-weight-bold h5">Giá: {!! number_format($product->amount) !!}đ</span>
                    <span class="text-danger font-weight-bold h5">Số điện thoại: {!! $product->phone !!}</span>
                    <span class="text-danger font-weight-bold h5">Địa chỉ: {!! $product->address !!}</span>
                    <span class="text-danger font-weight-bold h5">
                        Dịch vụ: @foreach($product->services as $service) @if($loop->last) {!! $service->name . '.' !!} @else {!! $service->name . ', ' !!} @endif @endforeach
                    </span>
                    @if($bookmarkId)
                        <span class="text-success font-weight-bold h5"><i id="js-bookmark" class="mdi mdi-bookmark-minus-outline" data-bookmark="{{ $bookmarkId }}" style="font-size: xx-large"></i></span>
                    @else
                        <span class="text-dark font-weight-bold h5"><i id="js-bookmark" class="mdi mdi-bookmark-plus-outline" style="font-size: xx-large"></i></span>
                    @endif
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
        <div class="tab-pane fade" id="images">
            <div class="row">
            @foreach ($product->images as $image)
                <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                    <a href="{!! $image->getUrl() !!}" data-fancybox="gallery" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="{!! $image->getUrl('thumb') !!}">
                    </a>
                </div>
            @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="content">{!! $product->content !!}</div>
        <div class="tab-pane fade" id="reports">
            <a href="{{ route('admin.products.reports.create', $product->id) }}" class="btn btn-outline-success mb-5 col-12"><i class="mdi mdi-pen"></i> Viết report</a>
            @foreach($product->reports as $report)
            <div class="media mb-3">
                <img class="mr-3" src="{!! $report->user->thumbnailUrl !!}" alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">{!! $report->user->name !!}</h5>
                    {!! $report->excerpt !!}
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
                                        <table class="table table-dark">
                                            <tbody>
                                            @foreach(json_decode($report->properties) as $key => $property)
                                                <tr>
                                                    <td>{{$property->key}}</td>
                                                    <td>{{$property->value}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        @foreach ($report->images as $image)
                                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                                <a href="{!! $image->getUrl() !!}" data-fancybox="galleryReport{!! $report->id !!}" class="d-block mb-4 h-100">
                                                    <img class="img-fluid img-thumbnail" src="{!! $image->getUrl('thumb') !!}">
                                                </a>
                                            </div>
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
            <h2>Bình luận ({!! count($product->comments) !!})</h2>
            <div class="form-group" id="flag-insert-comment-after">
                <textarea class="form-control mb-2" name="content" placeholder="Comment đi ai cắm bạn vui cơ chứ" rows="4"></textarea>
                <button type="button" class="btn btn-gradient-primary mr-2 js-comment">Gửi bình luận</button>
            </div>
            @if (count($product->comments) > 0) @foreach($product->comments as $comment)
            <div class="media comment-box" data-comment="{!! $comment->id !!}">
                <div class="media-left">
                    <img class="img-responsive user-photo" src="{!! $comment->author->thumbnailUrl !!}">
                </div>
                <div class="media-body">
                    <div class="media-heading d-flex justify-content-between">
                        <span class="font-weight-bold">{!! $comment->author->name !!}</span>
                        <span class="font-italic">
                            <span class="mr-2">{!! $comment->created_at !!}</span>
                            <span class="js-show-box-reply-comment"><i class="mdi mdi-reply"></i> Trả lời</span>
                        </span>
                    </div>
                    <p>{!! $comment->content !!}</p>
                    <div class="box-reply d-none">
                        <textarea class="form-control mb-2" placeholder="Trả lời bình luận" rows="4">{{ "@" . $comment->author->name }} </textarea>
                        <button type="button" class="btn btn-gradient-primary js-send-reply-comment">Gửi Trả lời</button>
                    </div>
                    @foreach($comment->child as $commentChild)
                    <div class="media">
                        <div class="media-left">
                            <img class="img-responsive user-photo" src="{!! $commentChild->author->thumbnailUrl !!}">
                        </div>
                        <div class="media-body">
                            <div class="media-heading d-flex justify-content-between">
                                <span class="font-weight-bold">{!! $commentChild->author->name !!}</span>
                                <span class="font-italic">
                                    <span class="mr-2">{!! $commentChild->created_at !!}</span>
                                    <span class="js-show-box-reply-comment"><i class="mdi mdi-reply"></i> Trả lời</span>
                                </span>
                            </div>
                            <p>{!! $commentChild->content !!}</p>
                            <div class="box-reply d-none">
                                <textarea class="form-control mb-2" placeholder="Trả lời bình luận" rows="4">{{ "@" . $commentChild->author->name }} </textarea>
                                <button type="button" class="btn btn-gradient-primary js-send-reply-comment">Gửi Trả lời</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach @else <span>Hãy trở thành người viết bình luận đầu tiên</span> @endif
        </div>
    </div>
    <div id="block-nearby-product" class="mt-5">
        <h3>Sản phẩm gần đó</h3>
        <div class="row">
        @if(!empty($productsNearby))
            @foreach($productsNearby as $productNearby)
                <div class="col-12 col-md-4 col-lg-3 col-xl-3">
                    <img class="img-fluid img-thumbnail" src="{!! $productNearby->thumbnail !!}" alt="image" style="max-width:100%">
                    <div class="card-body">
                        <h4 class="card-title">{!! $productNearby->name !!}</h4>
                        <p class="card-text">{!! $productNearby->excerpt !!}</p>
                        <a href="{{ route('admin.products.show', $productNearby->id) }}" class="btn btn-primary">Xem chi tiết</a>
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
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        var isBusy = false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#block-comments .comment-box .js-show-box-reply-comment').on('click', function (e) {
            e.preventDefault();
            let boxReply = $(this).closest('.media-body').find('div.box-reply'),
                txtReply = boxReply.find('textarea'),
                content = txtReply.val(),
                strLength= content.length;
            boxReply.removeClass('d-none');
            txtReply.focus();
            txtReply[0].setSelectionRange(strLength, strLength);
        });

        $('#block-comments .js-send-reply-comment').on('click', function (e) {
            e.preventDefault();
            if (isBusy) {
                return false;
            }
            isBusy = true;
            let txtContentElement = $(this).siblings('textarea'),
                content = txtContentElement.val(),
                commentBox = $(this).parents('.comment-box');
            txtContentElement.val('');
            $.ajax({
                url: "{{ route('api.comment.create') }}",
                data: {
                    product_id: <?= $product->id ?>,
                    content: content,
                    user_id: <?= \Illuminate\Support\Facades\Auth::id()?>,
                    parent: commentBox.data('comment')
                },
                type: 'POST',
                success: function (response) {
                    isBusy = false;
                    if (response.status === true) {
                        let htmlComment = `<div class="media">
                            <div class="media-left">
                                <img class="img-responsive user-photo" src="${response.data.author_avatar}">
                            </div>
                            <div class="media-body">
                                <div class="media-heading d-flex justify-content-between">
                                    <span class="font-weight-bold">${response.data.author_name}</span>
                                    <span class="font-italic">
                                        <span class="mr-2">${response.data.created_at}</span>
                                    </span>
                                </div>
                                <p>${response.data.content}</p>
                            </div>
                        </div>`;
                        commentBox.find('.media-body').first().append(htmlComment);
                    }
                }
            });
        });

        $('#block-comments .js-comment').on('click', function (e) {
            e.preventDefault();
            if (isBusy) {
                return false;
            }
            isBusy = true;
            let content = $('#block-comments textarea[name=content]').val();
            $('#block-comments textarea[name=content]').val('');
            $.ajax({
                url: "{{ route('api.comment.create') }}",
                data: {product_id: <?= $product->id ?>, content: content, user_id: <?= \Illuminate\Support\Facades\Auth::id()?>},
                type: 'POST',
                success: function (response) {
                    isBusy = false;
                    if (response.status === true) {
                        let htmlComment = `<div class="media comment-box">
                                <div class="media-left">
                                    <img class="img-responsive user-photo" src="${response.data.author_avatar}">
                                </div>
                                <div class="media-body">
                                    <div class="media-heading d-flex justify-content-between">
                                        <span class="font-weight-bold">${response.data.author_name}</span>
                                        <span class="font-italic">
                                            <span class="mr-2">${response.data.created_at}</span>
                                        </span>
                                    </div>
                                    <p>${response.data.content}</p>
                                </div>
                            </div>
                        </div>`;
                        $(htmlComment).insertAfter('#flag-insert-comment-after');
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        $('#js-bookmark').on('click', function (e) {
            e.preventDefault();
            if (isBusy) {
                return false;
            }
            isBusy = true;
            if ($(this).hasClass('mdi-bookmark-plus-outline')) {
                $(this).removeClass('mdi-bookmark-plus-outline').addClass('mdi-bookmark-minus-outline');
                $(this).parent().removeClass('text-dark').addClass('text-success');
                $.ajax({
                    url: "{{ route('admin.products.bookmarks.store', $product->id) }}",
                    type: 'POST',
                    success: function (response) {
                        $('#js-bookmark').data('bookmark', response.id);
                        isBusy = false;
                    }
                });
            } else {
                $(this).removeClass('mdi-bookmark-minus-outline').addClass('mdi-bookmark-plus-outline');
                $(this).parent().removeClass('text-success').addClass('text-dark');
                let bookmark = $('#js-bookmark').data('bookmark');
                $.ajax({
                    url: "/administrator/bookmarks/"+bookmark,
                    type: 'DELETE',
                    success: function () {
                        isBusy = false;
                    }
                });
            }
        });
    </script>
@endsection
