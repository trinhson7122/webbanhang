@extends('client.parent')
@section('client_content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mt-2">Yêu cầu của tôi</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto justify-content-center">
                <table align="center" class="table table-borderless table-responsive table-centered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ghi chú</th>
                            <th>Địa chỉ</th>
                            <th>Tình trạng</th>
                            <th>Tổng tiền</th>
                            <th style="width: 50px;"></th>
                            <th style="width: 50px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->note }}</td>
                                <td>{{ $item->address }}</td>
                                <td><div class="{{ $item->displayStatus() }}">{{ $item->printStatus() }}</div></td>
                                <td>{{ printMoney($item->sum_price) }}</td>
                                <td>
                                    <form action="{{ route('order.showOrderDetails', $item->id) }}" method="get">
                                        <button data-toggle="modal" data-target="#view-order-modal" type="button" class="btn btn-info btn-view-order1">Xem</button>
                                    </form>
                                </td>
                                @if ($item->status == 1)
                                    <td>
                                        <form action="{{ route('order.update', $item->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="status" value="0">
                                            <button class="btn btn-danger">Hủy</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- View -->
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
                    {{-- <button type="submit" class="btn btn-warning">Cập nhật mã giảm giá</button> --}}
                </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection