
<!DOCTYPE html>
<html lang="it">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>{{ settings('website.title') }}</title>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href="https://fonts.googleapis.com/css?family=Monda" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ Theme::asset('css/website.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="/">VANTI</a>
                </div>

                @inject('menuRepo', 'App\Repositories\MenuRepository')
                @set('menu', $menuRepo->findByName('top'))
                @set('menuItems', $menuRepo->getEntities($menu->id))

                @if ($menuItems->count())
                    <div id="menu" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            @each('vanti::partials.menu', $menuItems, 'item')
                        </ul>
                    </div>
                @endif
            </div>
        </nav>

        @yield('content')

        <section class="footer">
            <p>{{ settings('website.footer') }}</p>
        </section>

        <script type="text/javascript" src="{{ Theme::asset('js/plugins.js') }}"></script>
        <script type="text/javascript" src="{{ Theme::asset('js/website.js') }}"></script>
    </body>
</html>
