@extends('admin.layout')
@section('admin_content')
    <div id="app" class="container-fluid">
        <div class="title mt-2 mb-2">
            <h2 class="mt-2 mb-2">Quản lý yêu cầu</h2>
        </div>
        
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
                        <th>Người đặt</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Giá tiền</th>
                        <th>Trạng thái</th>
                        <th>Thêm lúc</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $each)
                        <tr>
                            <td>{{ $each->id }}</td>
                            <td>{{ $each->user->name }}</td>
                            <td>{{ $each->phone }}</td>
                            <td>{{ $each->address }}</td>
                            <td>{{ $each->sum_price }}</td>
                            <td><div class="{{ $each->displayStatus() }}">{{ $each->printStatus() }}</div></td>
                            <td>{{ $each->created_at }}</td>
                            <td>
                                <form action="{{ route('order.showOrderDetails', $each->id) }}" method="get">
                                    <button data-toggle="modal" data-target="#view-order-modal" type="button" class="btn btn-info btn-view-order">Xem</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('order.update', $each->id) }}" method="get">
                                    <button data-toggle="modal" data-target="#update-status-order-modal" type="button" class="btn btn-show-status btn-success">Status</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('order.destroy', $each->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="confirm-submit btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
        <!-- Add coupon Modal -->
        <div id="view-order-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header modal-colored-header bg-warning">
                        <h4 class="modal-title" id="primary-header-modalLabel">Thông tin yêu cầu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                    </div>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
    <div id="update-status-order-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post">
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-success">
                            <h4 class="modal-title" id="primary-header-modalLabel">Cập nhật trạng trái</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="status" class="custom-select">
                                    <option value="0">Hủy</option>
                                    <option value="1">Đang xử lý</option>
                                    <option value="2">Đang giao hàng</option>
                                    <option value="3">Đã giao hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-success">Cập nhật</button>
                        </div>
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@endsection
