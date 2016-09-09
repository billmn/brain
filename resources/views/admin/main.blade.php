<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') | {{ trans('admin.app.name') }}</title>

        <!-- Admin Styles
        ================================================== -->
        <link href="/assets/css/main.css" rel="stylesheet">

        @yield('styles')
        @include('admin.scripts')
    </head>
    <body id="admin">
        @include('admin.sidebar')
        @include('admin.menu')

        @section('main')
            <div class="pusher">
                <div id="content" class="ui container">
                    @yield('content')
                </div>
            </div>
        @show

        <!-- Admin JS
        ================================================== -->
        <script src="/assets/js/app.js"></script>
        <script src="/assets/js/vendor.js"></script>
        <script src="/assets/js/admin.js"></script>

        @yield('scripts')
    </body>
</html>
