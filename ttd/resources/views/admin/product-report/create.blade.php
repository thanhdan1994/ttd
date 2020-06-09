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
        <h3 class="page-title">Viết report</h3>
    </div>
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4>Tên sản phẩm: {!! $product->name !!}</h4>
                    <form class="forms-sample" method="post" action="{{ route('admin.products.reports.store', $product->id) }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="featured_image" />
                        <div class="form-group">
                            <textarea class="form-control" name="excerpt" id="excerpt"
                                      placeholder="Mô tả nguyên nhân report" row="6">{{ old('excerpt') }}</textarea>
                        </div>
                        <div class="row pt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Thông tin đánh giá</th>
                                            <th scope="col">Điểm số</th>
                                        </tr>
                                        </thead>
                                        <tbody id="content-properties">
                                            <tr>
                                                <th scope="row"><input type="text" name="properties[0][key]" class="form-control" value="Giá hợp lý"></th>
                                                <td><input type="text" name="properties[0][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" name="properties[1][key]" class="form-control" value="Sản phẩm như hình"></th>
                                                <td><input type="text" name="properties[1][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" name="properties[2][key]" class="form-control" value="Shop vui vẻ"></th>
                                                <td><input type="text" name="properties[2][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" name="properties[3][key]" class="form-control" value="Giao hàng nhanh"></th>
                                                <td><input type="text" name="properties[3][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" name="properties[4][key]" class="form-control" value="Nhân viên vui vẻ"></th>
                                                <td><input type="text" name="properties[4][value]" class="form-control" value="7"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="file col-12">
                                <input type="file" name="images[]" id="images" multiple aria-label="File browser example">
                                <span class="file-custom"></span>
                            </label>
                        </div>
                        <div class="row form-group preview-images">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary mr-2">Lưu lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Custom js for this page -->
    <script src="{{asset('admin/assets/js/file-upload.js')}}"></script>
    <!-- End custom js for this page -->
@endsection
