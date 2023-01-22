@extends('client.parent')
@section('client_content')
@include('client.layouts.slidebar')
<div class="row justify-content-center">
    <div class="col-xl-10">

        <!-- Pricing Title-->
        <div class="text-center mt-5">
            <h3 class="mb-2 text-dark">SẢN PHẨM MỚI</h3>
        </div>

        <!-- Plans -->
        <div class="row mt-sm-5 mt-3 mb-3">
            @foreach ($newProducts as $item)
                <div class="col-md-3">
                    <div class="card card-pricing">
                        <div class="card-body text-center">
                            <img class="img-fluid" src="{{ $item->image }}" alt="product">
                            <p class="card-pricing-plan-name font-weight-bold text-uppercase mt-2">{{ $item->name }}</p>
                            <h2>{{ printMoney($item->price) }}</h2>
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="button" class="btn-add-to-cart btn btn-warning mt-4 mb-2">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
            @endforeach
        </div>
        <!-- end row -->
        <!-- Pricing Title-->
        <div class="text-center mt-5">
            <h3 class="mb-2 text-dark">SẢN PHẨM</h3>
        </div>

        <!-- Plans -->
        <div class="row mt-sm-5 mt-3 mb-3">
            @foreach ($products as $item)
                <div class="col-md-3">
                    <div class="card card-pricing">
                        <div class="card-body text-center">
                            <img class="img-fluid" src="{{ $item->image }}" alt="product">
                            <p class="card-pricing-plan-name font-weight-bold text-uppercase mt-2">{{ $item->name }}</p>
                            <h2>{{ printMoney($item->price) }}</h2>
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="button" class="btn-add-to-cart btn btn-warning mt-4 mb-2">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div> <!-- end Pricing_card -->
                </div> <!-- end col -->
            @endforeach
        </div>
        {{ $products->links() }}
        <!-- end row -->

    </div> <!-- end col-->
</div>
@endsection