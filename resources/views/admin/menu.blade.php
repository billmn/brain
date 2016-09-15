@section('menu')
<div class="ui top fixed menu">
    <a class="item" href="javascript:$('.ui.labeled.icon.sidebar').sidebar('toggle');">
        <img src="/assets/img/logo.jpg">
    </a>

    @hasSection('title')
        <div class="header item section-title">@yield('title')</div>
    @endif

    <div class="right menu">
        <a class="item icon-only" href="/" target="_blank">
            <i class="external icon"></i>
        </a>

        <div class="ui dropdown item">
            <img class="ui avatar image" src="{{ gravatar(Auth::user()->email) }}">&nbsp;&nbsp;
            {{ Auth::user()->name }}<i class="dropdown icon"></i>

            <div class="menu">
                <a href="#" class="ui item" onclick="event.preventDefault(); $('#logout-form').submit();">
                    {{ trans('admin.auth.logout.button') }}
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
</div>
@show
