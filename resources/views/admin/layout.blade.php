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
<script>
    setInterval(() => {
        location.reload();
    }, 1000 * 60);
</script>
@endsection