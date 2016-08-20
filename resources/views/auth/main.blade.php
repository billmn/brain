<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Admin Styles
        ================================================== -->
        <link href="/assets/css/main.css" rel="stylesheet">
    </head>
    <body id="auth">
        <div id="content" class="ui container">
            @yield('content')
        </div>

        <!-- Admin JS
        ================================================== -->
        @include('admin.scripts')

        <script src="/assets/js/app.js"></script>
        <script src="/assets/js/vendor.js"></script>

        @yield('scripts')
    </body>
</html>
