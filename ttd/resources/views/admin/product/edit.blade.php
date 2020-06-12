@extends('layouts.admin')

@section('head')
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Trang quản trị {{ env('APP_NAME') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
    </head>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Chỉnh sửa #{!! $product->id !!}</h3>
    </div>
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="post" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" value="{!! $product->name !!}" name="name" id="name" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Mô tả</label>
                            <textarea class="form-control"
                                      name="excerpt" id="excerpt"
                                      placeholder="Mô tả bài viêt" row="6">{!! $product->excerpt !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Chuyên mục</label>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{!! $category->id !!}" @if ($category->id == $product->category_id) selected @endif>{!! $category->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="phone">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{!! $product->phone !!}" placeholder="số điện thoại">
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="amount">Giá</label>
                                    <input type="text" class="form-control" name="amount" id="amount" value="{!! $product->amount !!}" placeholder="giá sản phẩm">
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-4">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{!! $product->address !!}" placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="lat">Latitude</label>
                                    <input type="text" class="form-control" name="lat" id="lat" value="{!! $product->lat !!}" placeholder="latitude">
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <div class="form-group">
                                    <label for="long">Longitude</label>
                                    <input type="text" class="form-control" name="long" id="long" value="{!! $product->long !!}" placeholder="longitude">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Dịch vụ</label>
                            <div class="d-flex">
                                @foreach($services as $service)
                                <div class="form-check mr-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="services[]"
                                               @if($product->services->contains('id', $service->id)) checked @endif
                                               class="form-check-input" value="{{ $service->id }}">
                                        {{ $service->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file" name="featured_image" id="featured_image" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <span data-thumbnail="{!! $product->thumbnailUrl !!}" class="input-group-append file-upload-browse" style="background: url({!! $product->thumbnailUrl !!})">
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Nội dung sản phẩm</label>
                            <textarea class="form-control"
                                      id="content" name="content" rows="4"
                                      placeholder="Nội dung sản phẩm">{!! $product->content !!}</textarea>
                        </div>
                        <div class="row">
                            <label class="file col-12">
                                <input type="file" name="images[]" id="images" multiple aria-label="File browser example">
                                <span class="file-custom"></span>
                            </label>
                        </div>
                        <div class="row form-group preview-images">
                            @foreach ($product->images as $image)
                                <div class="input-group col-xs-12 col-3 pb-3">
                                    <span class="input-group-append file-upload-browse" style="background: url({!! $image->getUrl('thumb') !!});">
                                    </span>
                                    <label class="js-close-image-preview-2"><i class="mdi mdi-close-octagon"></i></label>
                                    <input type="hidden" name="images-base64[]"
                                           value="data:image/jpeg;base64,{!! base64_encode(
                                           file_get_contents(
                                               $image->getPath(),
                                               false,
                                               stream_context_create(array(
                                                        "ssl"=>array(
                                                            "verify_peer"=>false,
                                                            "verify_peer_name"=>false,
                                                        ),
                                                    )
                                                )
                                           )
                                    ) !!}">
                                </div>
                            @endforeach
                        </div>
                        <div class="row pt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">
                                        <button type="button" class="btn btn-outline-github" onclick="handleAddProperties()">Thêm thuộc tính</button>
                                    </label>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Thuộc tính</th>
                                            <th scope="col">Giá trị</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody id="content-properties">
                                        @if(is_array(json_decode($product->properties)))
                                            @foreach(json_decode($product->properties) as $key => $property)
                                                <tr>
                                                    <th scope="row">
                                                        <input type="text" name="properties[{{$key}}][key]" class="form-control" value="{{$property->key}}">
                                                    </th>
                                                    <td>
                                                        <input type="text" name="properties[{{$key}}][value]" class="form-control" value="{{$property->value}}">
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">Xóa</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                            <input type="checkbox" name="status" class="form-check-input" {!! $product->status ? 'checked' : '' !!}> Kích hoạt <i class="input-helper"></i></label>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2 mt-3">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Custom js for this page -->
    <script src="{{asset('admin/assets/js/file-upload.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ), {
                ckfinder: {
                    uploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                    options: {
                        resourceType: 'Images'
                    }
                },
                toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' , 'mediaEmbed' ]
            } )
            .catch( function( error ) {
                console.error( error );
            } );
    </script>
    <script>
        const contentProperties = document.getElementById('content-properties');
        var numberRow = 100;
        function handleAddProperties() {
            numberRow += 1;
            let rowElement = document.createElement('tr');
            let columnThElement = document.createElement('th');
            columnThElement.scope = "row";
            columnThElement.innerHTML = '<input type="text" name="properties['+ numberRow +'][key]" class="form-control" />';
            let columnTd1Element = document.createElement('td');
            columnTd1Element.innerHTML = '<input type="text" name="properties['+ numberRow +'][value]" class="form-control" />';
            let columnTd2Element = document.createElement('td');
            let buttonRemoveElement = document.createElement('button');
            buttonRemoveElement.type = "button";
            buttonRemoveElement.className = "btn btn-sm btn-danger";
            buttonRemoveElement.innerText = "Xóa";
            buttonRemoveElement.addEventListener('click', handleRemoveProperties);
            columnTd2Element.append(buttonRemoveElement);
            rowElement.append(columnThElement);
            rowElement.append(columnTd1Element);
            rowElement.append(columnTd2Element);
            contentProperties.append(rowElement);
        }

        function handleRemoveProperties() {
            this.closest('tr').remove();
        }
    </script>
    <!-- End custom js for this page -->
@endsection
