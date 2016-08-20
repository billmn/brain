@extends('admin.main')

@section('title', trans('admin.home.title'))

@section('content')
<div class="ui grid">
    <div class="eight wide column">
        <div class="ui teal statistics">
            <div class="statistic">
                <div class="value">{{ $total['pages'] }}</div>
                <div class="label">{{ trans('admin.pages.plur') }}</div>
            </div>
            <div class="teal statistic">
                <div class="value">{{ $total['users'] }}</div>
                <div class="label">{{ trans('admin.settings.users.plur') }}</div>
            </div>
        </div>
    </div>
    <div class="eight wide column">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>

    @for ($i = 0; $i < 20; $i++)
        <div class="sixteen wide column">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
    @endfor
</div>
@endsection
