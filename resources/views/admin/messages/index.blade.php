@extends('admin.main')

@section('title', trans('admin.messages.title'))

@section('content')
    <div class="ui menu">
        <div class="right menu">
            <div class="item">{{ trans('admin.common.total') }}: {{ $messages->total() }}</div>
        </div>
    </div>

    <table class="ui table striped">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('admin.messages.fields.form_name') }}</th>
                <th>{{ trans('admin.messages.fields.email') }}</th>
                <th>{{ trans('admin.messages.fields.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->form_name }}</td>
                <td>
                    <a href="{{ route('messages.show', $message->id) }}" class="modal-iframe">
                        {{ $message->email }}
                    </a>
                </td>
                <td>{{ $message->created_at }}</td>
                <td class="actions right aligned">
                    {!! Form::delete(route('messages.destroy', $message->id)) !!}
                </td>
            </tr>
            @empty
            <tr>
                <td class="empty" colspan="5">{{ trans('admin.messages.empty') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $messages->links('vendor.pagination.semantic-ui') }}
@endsection
