@extends('client.parent')
@section('client_content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mt-2">Giỏ hàng</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body load-page">
                    @if (session()->has('cart'))
                    <div class="row" id="load-page">
                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-borderless table-centered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá tiền</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                            <th style="width: 50px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach (session()->get('cart') as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ config('app.url') . $item['image'] }}" alt="product-img" title="product-img" class="rounded mr-3" height="64">
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    {{ $item['name'] }}
                                                </p>
                                            </td>
                                            <td>
                                                {{ printMoney($item['price']) }}
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.store') }}" method="post">
                                                    @csrf
                                                    <input class="input-update-cart form-control" name="amount" type="number" min="1" value="{{ $item['count'] }}" placeholder="Qty" style="width: 90px;">
                                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                </form>
                                            </td>
                                            <td>
                                                {{ printMoney($item['price'] * $item['count']) }}
                                            </td>
                                            <td>
                                                <form action="{{ route('cart.destroy', $item['id']) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn action-icon"><i class="mdi mdi-delete"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                            <!-- action buttons-->
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{ route('index') }}" class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
                                        <i class="mdi mdi-arrow-left"></i> Tiếp tục mua sắm </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-right">
                                        <a href="{{ route('checkout') }}" class="btn btn-danger">
                                            <i class="mdi mdi-cart-plus mr-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                        <!-- end col -->

                        <div class="col-lg-4">
                            <div class="border p-3 mt-4 mt-lg-0 rounded">
                                <h4 class="header-title mb-3">Tổng quan</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Tổng tiền :</td>
                                                <td>{{ printMoney($sumCart) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Discount : </td>
                                                <td>-{{ printMoney($discount) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Thành tiền :</th>
                                                <td>{{ printMoney($sumCart - $discount) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table-responsive -->
                            </div>

                            <div class="alert alert-warning mt-3" role="alert">
                                Nhập mã giảm giá <strong>KMCUASON1</strong> và nhận khuyến mãi 10% !
                            </div>

                            <form action="{{ route('coupon.find') }}" method="post">
                                @csrf
                                <div class="input-group mt-3">
                                    <input type="text" name="name" class="form-control form-control-light" placeholder="Mã giảm giá" aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-light" type="submit">Apply</button>
                                    </div>
                                </div>
                            </form>

                        </div> <!-- end col -->

                    </div> <!-- end row -->
                    @else
                    <div class="text-center">
                        <img class="img-fluid" src="{{ asset('images/empty-cart.png') }}" alt="empty-cart">
                    </div>
                    @endif
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

</div>
@endsection