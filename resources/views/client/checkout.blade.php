@extends('client.parent')
@section('client_content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mt-2">Checkout</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Checkout Steps -->
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                        <li class="nav-item">
                            <a href="#billing-information" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                                <i class="mdi mdi-account-circle font-18"></i>
                                <span class="d-none d-lg-block">Thông tin thanh toán</span>
                            </a>
                        </li>
                    </ul>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Steps Information -->
                    <div class="tab-content">

                        <!-- Billing Content-->
                        <div class="tab-pane show active" id="billing-information">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mt-2">Thông tin thanh toán</h4>

                                    <p class="text-muted mb-4">Điền vào mẫu dưới đây để
                                        gửi cho bạn hóa đơn của đơn đặt hàng.</p>

                                    <form action="{{ route('order.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing-first-name">Họ và tên <span class="text-danger">*</span></label>
                                                    <input readonly value="{{ auth()->user()->name }}" class="form-control" type="text" placeholder="Điền họ và tên" id="billing-first-name">
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing-email-address">Địa chỉ email <span class="text-danger">*</span></label>
                                                    <input readonly value="{{ auth()->user()->email }}" class="form-control" type="email" placeholder="Điền địa chỉ email" id="billing-email-address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="billing-phone">Số điện thoại <span class="text-danger">*</span></label>
                                                    <input name="phone" value="{{ auth()->user()->phone }}" class="form-control" type="number" placeholder="Điền số điện thoại" id="billing-phone">
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="billing-address">Địa chỉ <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" placeholder="Điền địa chỉ giao hàng" name="address" cols="30" rows="2">{{ auth()->user()->address }}</textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3">
                                                    <label for="example-textarea">Ghi chú: </label>
                                                    <textarea class="form-control" name="note" id="example-textarea" rows="2" placeholder="Điền ghi chú"></textarea>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->

                                        <div class="row mt-4">
                                            <div class="col-sm-6">
                                                <a href="{{ route('cart') }}" class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
                                                    <i class="mdi mdi-arrow-left"></i> Quay lại giỏ hàng </a>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="text-sm-right">
                                                    <button class="btn btn-danger">
                                                        <i class="mdi mdi-truck-fast mr-1"></i> Đặt hàng </button>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border p-3 mt-4 mt-lg-0 rounded">
                                        <h4 class="header-title mb-3">Chi tiết yêu cầu</h4>

                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0">
                                                <tbody>
                                                    @foreach ($cartDetails as $item)
                                                    <tr>
                                                        <td>
                                                            <img src="{{ config('app.url') . $item->product->image }}" alt="contact-img" title="contact-img" class="rounded mr-2" height="48">
                                                            <p class="m-0 d-inline-block align-middle">
                                                                <span class="text-body font-weight-semibold">{{ $item->product->name }}</span>
                                                                <br>
                                                                <small>{{ $item->amount }} x {{ printMoney($item->product->price) }}</small>
                                                            </p>
                                                        </td>
                                                        <td class="text-right">
                                                            {{ printMoney($item->product->price * $item->amount) }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    <tr class="text-right">
                                                        <td colspan="2">
                                                            <span class="bold">
                                                                Tổng tiền: 
                                                            </span>
                                                            <span>
                                                                {{ printMoney($cart->sumCart()) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-right">
                                                        <td colspan="2">
                                                            <span class="bold">
                                                                Giảm giá: 
                                                            </span>
                                                            <span>
                                                                -{{ printMoney($discount) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-right">
                                                        <tr class="text-right">
                                                            <td colspan="2">
                                                                <span class="bold">
                                                                    Thành tiền: 
                                                                </span>
                                                                <span>
                                                                    {{ printMoney($cart->sumCart() - $discount) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div> <!-- end .border-->

                                </div> <!-- end col -->            
                            </div> <!-- end row-->
                        </div>
                        <!-- End Billing Information Content-->
                    </div> <!-- end tab content-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->

</div>
@endsection