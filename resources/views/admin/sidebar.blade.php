@section('sidebar')
<div class="ui left vertical inverted sidebar labeled icon menu">
    <a class="item" href="{{ route('home.index') }}">
        <i class="home icon"></i> {{ trans('admin.home.title') }}
    </a>
    <a class="item" href="{{ route('pages.index') }}">
        <i class="file text icon"></i> {{ trans('admin.pages.title') }}
    </a>
    <a class="item" href="{{ route('menus.index') }}">
        <i class="compass icon"></i> {{ trans('admin.menus.title') }}
    </a>
    <a class="item modal-files" href="javascript:;">
        <i class="image icon"></i> Files
    </a>
    <a class="item" href="{{ route('forms.index') }}">
        <i class="checkmark box icon"></i> {{ trans('admin.forms.title') }}
    </a>
    <a class="item" href="{{ route('labels.index') }}">
        <i class="tag icon"></i> {{ trans('admin.labels.title') }}
    </a>
    <a class="item" href="{{ route('themes.index') }}">
        <i class="eyedropper icon"></i> {{ trans('admin.themes.title') }}
    </a>
    <a class="item" href="{{ route('settings.index') }}">
        <i class="setting icon"></i> {{ trans('admin.settings.title') }}
    </a>
</div>
@show
