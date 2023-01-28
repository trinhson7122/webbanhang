@extends('admin.layout')
@section('admin_content')
    <div id="app" class="container-fluid">
        <div class="title mt-2 mb-2">
            <h2 class="mt-2 mb-2">Quản lý mã giảm giá</h2>
        </div>
        <form method="get">
            <div class="mt-2 mb-2 row">
                <div class="col-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-coupon-modal">Thêm mã giảm giá</button>
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
                        <th>Tên mã</th>
                        <th>Giảm (%)</th>
                        <th>Số lượng còn</th>
                        <th>Thêm bởi</th>
                        <th>Thêm lúc</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $each)
                        <tr>
                            <td>{{ $each->id }}</td>
                            <td>{{ $each->name }}</td>
                            <td>{{ $each->discount }}</td>
                            <td>{{ $each->amount }}</td>
                            <td>{{ $each->user->name }}</td>
                            <td>{{ $each->created_at }}</td>
                            <td>
                                <form action="{{ route('coupon.show', $each->id) }}" method="get">
                                    <button data-toggle="modal" data-target="#edit-coupon-modal" type="button" class="btn btn-warning btn-edit-coupon">Sửa</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('coupon.destroy', $each->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="confirm-submit btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $coupons->links() }}
        </div>
        <!-- Add coupon Modal -->
        <div id="add-coupon-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('coupon.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-success">
                            <h4 class="modal-title" id="primary-header-modalLabel">Thêm mã giảm giá</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tên Mã</label>
                                <input type="text" name="name" class="form-control">
                                <div class="alert-danger error-name error"></div>
                            </div>
                            <div class="form-group">
                                <label>Phần trăm giảm</label>
                                <input type="number" name="discount" class="form-control" value="10">
                                <div class="alert-danger error-price error"></div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng mã</label>
                                <input type="number" name="amount" class="form-control" value="100">
                                <div class="alert-danger error-amount error"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success" id="btn-add-product">Thêm mã giảm giá</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- Edit Product Modal -->
        <div id="edit-coupon-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('coupon.update', 1) }}">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-warning">
                            <h4 class="modal-title" id="primary-header-modalLabel">Sửa mã giảm giá</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tên Mã</label>
                                <input type="text" name="name" class="form-control">
                                <div class="alert-danger error-name error"></div>
                            </div>
                            <div class="form-group">
                                <label>Phần trăm giảm</label>
                                <input type="number" name="discount" class="form-control">
                                <div class="alert-danger error-price error"></div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng mã</label>
                                <input type="number" name="amount" class="form-control">
                                <div class="alert-danger error-amount error"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-warning">Cập nhật mã giảm giá</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
@endsection
