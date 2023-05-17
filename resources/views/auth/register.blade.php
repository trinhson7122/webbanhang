@extends('client.parent')
@section('client_content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card">
                <!-- Logo-->
                <div class="card-header text-center bg-dark">
                    <a href="index.html">
                        <span><img src="{{ asset('images/logo.png') }}" width="50"></span>
                    </a>
                </div>

                <div class="card-body p-4">
                    
                    <div class="text-center w-75 m-auto">
                        <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Đăng ký</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('auth.registering') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input class="form-control" name="name" type="text" id="fullname" placeholder="Enter your name" required="">
                        </div>

                        <div class="form-group">
                            <label for="emailaddress">Địa chỉ email</label>
                            <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                        </div>

                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <div class="input-group input-group-merge">
                                <input name="password" type="password" id="password" class="form-control" placeholder="Enter your password">
                                <div class="input-group-append" data-password="false">
                                    <div class="input-group-text">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary" type="submit">Đăng ký</button>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div>
            <!-- end card -->

            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="text-muted">Đã có tài khoản? <a href="{{ route('auth.login') }}" class="text-muted ml-1"><b>Đăng nhập</b></a></p>
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection