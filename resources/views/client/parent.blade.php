@extends('master')
@section('content')
<div class="content">
    @include('client.layouts.topbar')
    <div class="mb-5"></div>
    <div class="container-fluid">
        @yield('client_content')
    </div>
</div>
@endsection