@extends('admin.main')

@section('title', trans('admin.menus.title'))

@section('content')
    <div class="ui menu">
        <a class="green item" href="{{ route('menus.create') }}">
            <i class="plus icon"></i>
            {{ trans('admin.actions.create') }} {{ trans('admin.menus.sing') }}
        </a>

        <div class="right menu">
            <div class="item">{{ trans('admin.common.total') }}: {{ $menus->count() }}</div>
        </div>
    </div>

    <div class="ui top attached tabular menu" data-cookie="admin_menu_lists_tab">
        <a class="item active" data-tab="lists">{{ trans('admin.menus.tabs.lists') }}</a>

        @if (count($menuPositions))
            <a class="item" data-tab="positions">{{ trans('admin.menus.tabs.positions') }}</a>
        @endif
    </div>

    <div class="ui bottom attached tab segment active" data-tab="lists">
        <table class="ui table striped">
            <thead>
                <tr>
                    <th>{{ trans('admin.menus.fields.name') }}</th>
                    <th>{{ trans('admin.menus.fields.title') }}</th>
                    <th>{{ trans('admin.common.created_at') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>{{ $menu->name }}</td>
                    <td>{{ $menu->title }}</td>
                    <td>{{ $menu->created_at }}</td>
                    <td class="actions right aligned">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="ui button"><i class="write icon"></i></a>
                        {!! Form::delete(route('menus.destroy', $menu->id)) !!}
                    </td>
                </tr>
                @empty
                <tr>
                    <td class="empty" colspan="5">{{ trans('admin.menus.empty') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (count($menuPositions))
        <div class="ui bottom attached tab segment" data-tab="positions">
            {!! Form::model($menuPositionsValues, ['route' => 'menus.positions']) !!}
                <div class="ui form">
                    @set('positionsList', [0 => trans('admin.menus.default_position')] + $menus->pluck('name', 'id')->toArray())

                    @foreach($menuPositions as $position => $label)
                        <div class="field">
                            {!! Form::label($label) !!}
                            {!! Form::select($position, $positionsList) !!}
                        </div>
                    @endforeach

                    <button class="ui button primary" type="submit">
                        <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    @endif
@endsection
