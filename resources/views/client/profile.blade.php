@extends('client.parent')
@section('client_content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title mt-2">Hồ sơ</h4>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
    @endif

    <div class="card text-center">
        <div class="card-body">
            <img src="{{ config('app.url') . $user->image }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

            <h4 class="mb-0 mt-2">{{ $user->name }}</h4>
            <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-info btn-sm mb-2">Sửa hồ sơ</a>

            <div class="text-center mt-3">
                <h4 class="font-13 text-uppercase">Thông tin cá nhân :</h4>
                <p class="text-muted mb-2 font-13"><strong>Tên :</strong> <span class="ml-2">{{ $user->name }}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Số điện thoại :</strong><span class="ml-2">{{ $user->phone }}</span></p>

                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 ">{{ $user->email }}</span></p>

                <p class="text-muted mb-1 font-13"><strong>Địa chỉ :</strong> <span class="ml-2">{{ $user->address }}</span></p>
            </div>
        </div> <!-- end card-body -->
    </div>
</div>
@endsection