@extends('master')
@section('content')
@include('admin.layouts.left-sidebar')
<div class="content-page">
    <div class="content">
        @include('admin.layouts.topbar')
        @yield('admin_content')
    </div>
    @include('admin.layouts.footer')
</div>
@endsection