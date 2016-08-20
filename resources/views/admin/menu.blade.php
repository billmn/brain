@section('menu')
<div class="ui top fixed menu">
    <a class="item" href="javascript:$('.ui.labeled.icon.sidebar').sidebar('toggle');">
        <img src="/assets/img/logo.jpg">
    </a>

    @hasSection('title')
        <div class="header item">@yield('title')</div>
    @endif

    <div class="right menu">
        <a class="item icon-only" href="/" target="_blank">
            <i class="external icon"></i>
        </a>

        <div class="ui dropdown item">
            {{ Auth::user()->name }} <i class="dropdown icon"></i>

            <div class="menu">
                <a class="ui item" href="/logout">{{ trans('admin.auth.logout.button') }}</a>
            </div>
        </div>
    </div>
</div>
@show
