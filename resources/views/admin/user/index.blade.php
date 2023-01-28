@extends('admin.layout')
@section('admin_content')
    <div id="app" class="container-fluid">
        <div class="title mt-2 mb-2">
            <h2 class="mt-2 mb-2">Quản lý người dùng</h2>
        </div>
        <div class="mt-2 mb-2">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-user-modal">Thêm người dùng</button>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="table">
            <table class="table table-light">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Tạo lúc</th>
                        <th>Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $each)
                        <tr>
                            <td>{{ $each->id }}</td>
                            <td>{{ $each->name }}</td>
                            <td>{{ $each->email }}</td>
                            <td>{{ $each->phone }}</td>
                            <td>{{ $each->address }}</td>
                            <td>{{ $each->created_at }}</td>
                            <td>
                                <div>
                                    <form action="{{ route('user.destroy', $each->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="confirm-submit btn btn-danger">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
        <!-- Add product Modal -->
        <div id="add-user-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-success">
                            <h4 class="modal-title" id="primary-header-modalLabel">Thêm người dùng</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" name="image" class="form-control">
                                <div class="alert-danger error-image error"></div>
                            </div>
                            <div class="form-group">
                                <label>Tên đầy đủ</label>
                                <input type="text" name="name" class="form-control">
                                <div class="alert-danger error-name error"></div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                                <div class="alert-danger error-email error"></div>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="number" name="phone" class="form-control">
                                <div class="alert-danger error-phone error"></div>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="text" name="password" class="form-control">
                                <div class="alert-danger error-phone error"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success">Thêm người dùng</button>
                        </div>
                    </div><!-- /.modal-content -->
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
@endsection
