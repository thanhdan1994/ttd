@extends('layouts.admin')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Trang quản trị Du Lịch Cổ Thạch</title>
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/vendors/css/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css')}}">
        <link rel="shortcut icon" href="{{asset('admin/assets/images/favicon.png')}}" />
    </head>
@endsection

@section('content')
    <div class="page-header">
        <h3 class="page-title">Danh sách</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh sách</li>
            </ol>
        </nav>
    </div>
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{route('admin.products.index')}}">
                        <div class="form-group">
                            <label for="search">Tìm kiếm</label>
                            <input type="text" class="form-control" name="q" id="search" placeholder="tìm kiếm...">
                        </div>
                    </form>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th> STT </th>
                            <th> Tiêu đề </th>
                            <th> Ảnh </th>
                            <th> Dịch vụ </th>
                            <th> Chuyên mục </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $key => $product)
                            <tr>
                                <td class="py-1">
                                    @if(isset($_GET['page']))
                                        #{{(($_GET['page'] * config('constants.admin.paginate')) - config('constants.admin.paginate')) + ($key + 1)}}
                                    @else
                                        #{{$key + 1}}
                                    @endif
                                </td>
                                <td>{!! \Illuminate\Support\Str::limit($product->name, 30, '...') !!}</td>
                                <td><img src="{!! $product->thumbnailUrl !!}" style="width: 200px; height: 150px"/></td>
                                <td>
                                    @foreach($product->services as $service)
                                        - {{ $service->name }} </br>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td class="d-flex flex-column">
                                    <a href="{{ route('admin.products.show', $product->id) }}" type="button" class="btn btn-outline-info mb-2">
                                        <i class="mdi mdi-eye"></i> Chi tiết
                                    </a>
                                    <a href="{{ route('admin.products.comments.create', $product->id) }}" type="button" class="btn btn-outline-primary mb-2">
                                        <i class="mdi mdi-comment"></i> Viết comment
                                    </a>
                                    <a href="{{ route('admin.products.reports.create', $product->id) }}" type="button" class="btn btn-outline-success mb-2">
                                        <i class="mdi mdi-pen"></i> Viết report
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" type="button" class="btn btn-outline-warning">
                                        <i class="mdi mdi-database-edit"></i> Sửa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <div class="pagination-box pt-5 pb-5">
                            <div class="col-md-12">
                                <div class="pull-center">{{ $products->links('vendor.pagination.custom-pager') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
