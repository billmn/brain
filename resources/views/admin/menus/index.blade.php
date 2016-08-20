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
@endsection
