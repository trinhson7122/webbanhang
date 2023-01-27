@extends('client.parent')
@section('client_content')
    <div class="text-center">
        <i class="mdi mdi-check-bold text-success mdi-48px"></i>
        <h2 class="text-center text-danger bold text-uppercase">Đặt hàng thành công!</h2>
        <a href="{{ route('myOrder') }}" class="btn btn-light mr-2 mt-3">Xem chi tiết đơn hàng</a>
        <a href="{{ route('index') }}" class="btn btn-danger text-white mt-3">Tiếp tục mua hàng</a>
    </div>
@endsection