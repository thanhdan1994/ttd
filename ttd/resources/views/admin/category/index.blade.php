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
                            <th> Chuyên mục </th>
                            <th> Ảnh </th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $key => $category)
                            <tr>
                                <td class="py-1">
                                    @if(isset($_GET['page']))
                                        #{{(($_GET['page'] * config('constants.admin.paginate')) - config('constants.admin.paginate')) + ($key + 1)}}
                                    @else
                                        #{{$key + 1}}
                                    @endif
                                </td>
                                <td>{!! \Illuminate\Support\Str::limit($category->name, 30, '...') !!}</td>
                                <td><img src="{!! $category->thumbnailUrl !!}" style="width: 200px; height: 150px"/></td>
                                <td class="d-flex flex-column">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" type="button" class="btn btn-outline-warning">
                                        <i class="mdi mdi-database-edit"></i> Sửa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($categories instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <div class="pagination-box pt-5 pb-5">
                            <div class="col-md-12">
                                <div class="pull-center">{{ $categories->links('vendor.pagination.custom-pager') }}</div>
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
