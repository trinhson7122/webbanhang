@extends('admin.layout')
@section('admin_content')
    <div id="app" class="container-fluid">
        <div class="title mt-2 mb-2">
            <h2 class="mt-2 mb-2">Quản lý Slide</h2>
        </div>
        <button data-toggle="modal" data-target="#add-slide-modal" type="button" class="btn btn-show-status btn-success">Thêm Slide</button>
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
                        <th></th>
                        <th>Ảnh</th>
                        <th>Thêm bởi</th>
                        <th>Thêm lúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slides as $each)
                        <tr>
                            <td>
                                <form action="{{ route('slide.update', $each->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          <input class="submit-show-slide" value="1" name="display" type="checkbox" @if($each->display) checked @endif>
                                        </div>
                                    </div>
                                    <button class="btn btn-success">Save</button>
                                </form>
                            </td>
                            <td><img src="{{ config('app.url') . $each->image }}" width="100" alt="slide"></td>
                            <td>{{ $each->user->name }}</td>
                            <td>{{ DateTimeForHuman($each->created_at) }}</td>
                            <td>
                                @can('is-super-admin', auth()->user())
                                    <form action="{{ route('slide.destroy', $each->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="confirm-submit btn btn-danger">Xóa</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="add-slide-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="primary-header-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('slide.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-success">
                            <h4 class="modal-title" id="primary-header-modalLabel">Thêm slide</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh</label>
                            <input type="file" name="image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-success">Thêm</button>
                        </div>
                </form>
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@endsection
