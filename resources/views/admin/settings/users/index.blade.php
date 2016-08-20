@extends('admin.main')

@section('title', trans('admin.settings.users.title'))

@section('content')
    @include('admin.settings.menu')

    <div class="ui menu">
        <a class="green item" href="{{ route('settings.users.create') }}">
            <i class="plus icon"></i>
            {{ trans('admin.actions.create') }} {{ trans('admin.settings.users.sing') }}
        </a>

        <div class="right menu">
            <div class="item">{{ trans('admin.common.total') }}: {{ $users->count() }}</div>
        </div>
    </div>

    <table class="ui table striped">
        <thead>
            <tr>
                <th>{{ trans('admin.settings.users.fields.name') }}</th>
                <th>{{ trans('admin.settings.users.fields.email') }}</th>
                <th>{{ trans('admin.common.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td class="actions right aligned">
                    <a href="{{ route('settings.users.edit', $user->id) }}" class="ui button"><i class="write icon"></i></a>
                    {!! Form::delete(route('settings.users.destroy', $user->id)) !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
