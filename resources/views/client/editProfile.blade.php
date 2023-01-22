@extends('client.parent')
@section('client_content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mt-2">Sửa hồ sơ</h4>
            </div>
        </div>
    </div>

    <div class="card text-center">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-md-4">
                <div class="card-body">
                    <form action="{{ route('profile.update', $user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <img src="{{ $user->image }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                        <h4 class="mb-0 mt-2">{{ $user->name }}</h4>
                        <div class="text-center mt-3">
                            <h4 class="font-13 text-uppercase">Thông tin cá nhân :</h4>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input name="phone" type="number" class="form-control" value="{{ $user->phone }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                
                                <textarea name="address" cols="30" rows="5" class="form-control">{{ $user->address }}</textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success">Cập nhật hồ sơ</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>
@endsection