@extends('client.parent')
@section('client_content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 mt-5">
                <div class="card">
                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Đăng nhập</h4>
                        </div>

                        <form action="{{ route('auth.logining') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="emailaddress">Địa chỉ email</label>
                                <input value="{{ old('email') }}" class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>
                            <div class="form-group">
                                <a href="pages-recoverpw.html" class="text-muted float-right"><small>Quên mật khẩu ?</small></a>
                                <label for="password">Mật khẩu</label>
                                <div class="input-group input-group-merge">
                                    <input value="{{ old('password') }}" type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                    <div class="input-group-append" data-password="true">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" value="1" name="remember" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Ghi nhớ đăng nhập</label>
                                </div>
                            </div>
                            @if (session()->has('message'))
                                <div class="alert alert-danger">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary" type="submit"> Đăng nhập </button>
                            </div>
                        </form>

                        <div class="text-center mt-3 mb-3">
                            <p class="text-muted">Hoặc đăng nhập bằng mạng xã hội</p>
                            <ul class="social-list list-inline">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ route('auth.socialite_redirect', 'google') }}" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="{{ route('auth.socialite_redirect', 'github') }}" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-box"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Chưa có tài khoản?<a href="{{ route('auth.register') }}" class="text-muted ml-1"><b>Đăng ký</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection