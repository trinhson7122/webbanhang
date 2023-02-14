<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }} - {{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
        <meta content="Coderthemes" name="author" />
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <!-- App favicon -->
        {{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}

        <!-- App css -->
        <link href="{{ asset('/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
        <link href="{{ asset('/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" id="dark-style" />
        {{-- @livewireStyles --}}
    </head>

    <body class="loading1" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false'>
        <div class="wrapper">
            @yield('content')
        </div>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script>

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('82083a76e9d04123f1cd', {
            cluster: 'ap1'
            });

            var channel = pusher.subscribe('update-app');
            channel.bind('load', function(data) {
                location.reload();
                //alert(1);
            });
        </script>
        {{-- @livewireScripts --}}
        <script src="{{ asset('/js/vendor.min.js') }}"></script>
        <script src="{{ asset('/js/app.min.js') }}"></script>
        <script src="{{ asset('js/helper.js') }}"></script>
        <script src="{{ asset('/js/request.js') }}"></script>
        <script src="{{ asset('/js/main.js') }}"></script>
        <script src="{{ asset('js/chart.js') }}"></script>
    </body>
</html>