<?php
    $users_url = route('settings.users.index');
    $general_url = route('settings.general.index');
    $notfound_url = route('settings.notfound.index');
    $maintenance_url = route('settings.maintenance.index');
?>

<div class="ui labeled icon menu settings-menu">
    <a href="{{ $general_url }}" class="item {{ starts_with(Request::url(), $general_url) ? 'active' : 'inactive' }}">
        <i class="compass icon"></i> {{ trans('admin.settings.general.title') }}
    </a>
    <a href="{{ $users_url }}" class="item {{ starts_with(Request::url(), $users_url) ? 'active' : 'inactive' }}">
        <i class="users icon"></i> {{ trans('admin.settings.users.title') }}
    </a>
    <a href="{{ $notfound_url }}" class="item {{ starts_with(Request::url(), $notfound_url) ? 'active' : 'inactive' }}">
        <i class="warning sign icon"></i> {{ trans('admin.settings.notfound.title') }}
    </a>
    <a href="{{ $maintenance_url }}" class="item {{ starts_with(Request::url(), $maintenance_url) ? 'active' : 'inactive' }}">
        <i class="power icon"></i> {{ trans('admin.settings.maintenance.title') }}
    </a>
</div>
