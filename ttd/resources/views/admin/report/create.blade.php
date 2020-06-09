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
        <h3 class="page-title">Thêm sản phẩm mới</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm sản phẩm mới</li>
            </ol>
        </nav>
    </div>
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" method="post" action="{{ route('admin.reports.store') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" id="search-product" placeholder="Tìm sản phẩm report,...">
                            <input type="hidden" class="form-control" name="product_id" value="1000">
                        </div>
                        <input type="hidden" id="featured_image" />
                        <div class="form-group">
                            <label for="excerpt">Mô tả</label>
                            <textarea class="form-control" name="excerpt" id="excerpt"
                                      placeholder="Mô tả nguyên nhân report" row="6">{{ old('excerpt') }}</textarea>
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
                                            <th scope="col">Thông tin đánh giá</th>
                                            <th scope="col">Điểm số</th>
                                        </tr>
                                        </thead>
                                        <tbody id="content-properties">
                                            <tr>
                                                <th scope="row"><input type="text" disabled name="properties[0][key]" class="form-control" value="Giá hợp lý"></th>
                                                <td><input type="text" name="properties[0][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" disabled name="properties[1][key]" class="form-control" value="Sản phẩm như hình"></th>
                                                <td><input type="text" name="properties[1][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" disabled name="properties[2][key]" class="form-control" value="Shop vui vẻ"></th>
                                                <td><input type="text" name="properties[2][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" disabled name="properties[3][key]" class="form-control" value="Giao hàng nhanh"></th>
                                                <td><input type="text" name="properties[3][value]" class="form-control" value="7"></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><input type="text" disabled name="properties[4][key]" class="form-control" value="Nhân viên vui vẻ"></th>
                                                <td><input type="text" name="properties[4][value]" class="form-control" value="7"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5>Hình ảnh chi tiết</h5>
                            <input type="file" name="images[]" id="images" multiple>
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
