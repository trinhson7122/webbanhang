@extends('admin.layout')
@section('admin_content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 text-center">
                            <h5 class="text-muted font-weight-normal mt-0 text-truncate">Tổng lượt truy cập</h5>
                            <h3 class="my-2 py-1">{{ $allvisitor }}</h3>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 text-center">
                            <h5 class="text-muted font-weight-normal mt-0 text-truncate">Lượt truy cập tháng này</h5>
                            <h3 class="my-2 py-1">{{ $visitorInThisMonth }}</h3>
                            <p class="mb-0 text-muted">
                                @if ($visitorPercent >= 0)
                                <span class="text-success mr-2">
                                    <i class="mdi mdi-arrow-up-bold"></i>{{ $visitorPercent }} %</span>
                                @else
                                <span class="text-danger mr-2">
                                    <i class="mdi mdi-arrow-down-bold"></i>{{ $visitorPercent }} %</span>
                                @endif
                            </p>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 text-center">
                            <h5 class="text-muted font-weight-normal mt-0 text-truncate">Sản phẩm bán trong tháng</h5>
                            <h3 class="my-2 py-1">{{ $productInThisMonth }}</h3>
                            <p class="mb-0 text-muted">
                                @if ($productPercent >= 0)
                                <span class="text-success mr-2">
                                    <i class="mdi mdi-arrow-up-bold"></i>{{ $productPercent }} %</span>
                                @else
                                <span class="text-danger mr-2">
                                    <i class="mdi mdi-arrow-down-bold"></i>{{ $productPercent }} %</span>
                                @endif
                            </p>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div>
        </div>
        <div class="col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12 text-center">
                            <h5 class="text-muted font-weight-normal mt-0 text-truncate">Doanh thu tháng</h5>
                            <h3 class="my-2 py-1">{{ $tongDoanhThuThang }}</h3>
                            <p class="mb-0 text-muted">
                                @if ($percentDoanhThu >= 0)
                                <span class="text-success mr-2">
                                    <i class="mdi mdi-arrow-up-bold"></i>{{ $percentDoanhThu }} %</span>
                                @else
                                <span class="text-danger mr-2">
                                    <i class="mdi mdi-arrow-down-bold"></i>{{ $percentDoanhThu }} %</span>
                                @endif
                            </p>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div id="sanphamdaban" data-url="{{ route('order.order_detail_per_month') }}"></div>
        </div>
        <div class="col-md-6">
            <div id="yeucau" data-url="{{ route('order.order_per_month') }}"></div>
        </div>
    </div>
@endsection