@extends('admin.main')

@section('title', trans('admin.messages.title'))

@section('content')
    <div class="ui menu">
        <div class="right menu">
            <div class="item">{{ trans('admin.common.total') }}: {{ $messages->count() }}</div>
        </div>
    </div>

    <table class="ui table striped">
        <thead>
            <tr>
                <th>{{ trans('admin.messages.fields.form_name') }}</th>
                <th>{{ trans('admin.messages.fields.email') }}</th>
                <th>{{ trans('admin.messages.fields.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                <td>{{ $message->form_name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->created_at }}</td>
                <td class="actions right aligned">
                    <a href="{{ route('messages.show', $message->id) }}" class="ui button modal-iframe"><i class="eye icon"></i></a>
                    {!! Form::delete(route('messages.destroy', $message->id)) !!}
                </td>
            </tr>
            @empty
            <tr>
                <td class="empty" colspan="4">{{ trans('admin.messages.empty') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
