@extends('admin.layout')
@section('admin_content')
    <div id="app" class="container-fluid">
        <div class="title mt-2 mb-2">
            <h2 class="mt-2 mb-2">Quản lý sản phẩm</h2>
        </div>
        <form method="get">
            <div class="mt-2 mb-2 row">
                <div class="col-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-product-modal">Thêm sản phẩm</button>
                </div>
                <div class="col-2 align-items-center">
                    <div class="dataTables_type input-group">
                        <label>Sắp xếp với</label>
                        <select class="custom-select custom-select-sm ml-1 mr-1" id="select_type" name="type">
                            <option value="id">Id</option>
                            <option value="name">Tên</option>
                            <option value="price">Giá tiền</option>
                            <option value="amount">Số lượng</option>
                            <option value="created_at">Thêm lúc</option>
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="dataTables_type input-group">
                        <label>Kiểu sắp xếp</label>
                        <select class="custom-select custom-select-sm ml-1 mr-1" id="select_by" name="by">
                            <option value="asc">Tăng dần</option>
                            <option value="desc">Giảm dần</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    @if (session()->has('search'))
                        <input type="hidden" name="search" value="{{ session()->get('search') }}">
                    @endif
                    <button type="submit" class="btn btn-info">Sắp xếp</button>
                </div>
            </div>
        </form>
        
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table">
            <table class="table table-light">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Số lượng còn</th>
                        <th>Thêm bởi</th>
                        <th>Thêm lúc</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $each)
                        <tr>
                            <td>{{ $each->id }}</td>
                            <td><img src="{{ config('app.url') . $each->image }}" width="100" alt="product"></td>
                            <td>{{ $each->name }}</td>
                            <td>{{ $each->price }}</td>
                            <td>{{ $each->amount }}</td>
                            <td>{{ $each->user->name }}</td>
                            <td>{{ DateTimeForHuman($each->created_at) }}</td>
                            <td>
                                <form action="{{ route('product.show', $each->id) }}" method="get">
                                    <button data-toggle="modal" data-target="#edit-product-modal" type="button" class="btn btn-warning btn-edit-product">Sửa</button>
                                </form>
                            </td>
                            <td>
                                @can('is-super-admin', auth()->user())
                                <form action="{{ route('product.destroy', $each->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button  class="confirm-submit btn btn-danger">Xóa</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
        <!-- Add product Modal -->
        <div id="add-product-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-success">
                            <h4 class="modal-title" id="primary-header-modalLabel">Thêm sản phẩm</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control">
                                <div class="alert-danger error-image error"></div>
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control">
                                <div class="alert-danger error-name error"></div>
                            </div>
                            <div class="form-group">
                                <label>Giá tiền</label>
                                <input type="number" name="price" class="form-control">
                                <div class="alert-danger error-price error"></div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" name="amount" class="form-control">
                                <div class="alert-danger error-amount error"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success" id="btn-add-product">Thêm sản phẩm</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Edit Product Modal -->
        <div id="edit-product-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('product.update', 1) }}">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-warning">
                            <h4 class="modal-title" id="primary-header-modalLabel">Sửa sản phẩm</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="text" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Giá tiền</label>
                                <input type="number" name="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="number" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-warning">Cập nhật sản phẩm</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
@endsection
