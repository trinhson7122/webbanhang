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
        <div class="row">
            <table class="table table-borderless table-response table-centered mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ghi chú</th>
                        <th>Địa chỉ</th>
                        <th>Tình trạng</th>
                        <th>Tổng tiền</th>
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
                            <td><button class="btn btn-info">Xem</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection