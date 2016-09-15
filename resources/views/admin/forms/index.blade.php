@extends('admin.main')

@section('title', trans('admin.forms.title'))

@section('content')
    <div class="ui menu">
        <a class="green item" href="{{ route('forms.create') }}">
            <i class="plus icon"></i>
            {{ trans('admin.actions.create') }} {{ trans('admin.forms.sing') }}
        </a>

        <div class="right menu">
            <div class="item">{{ trans('admin.common.total') }}: {{ $forms->count() }}</div>
        </div>
    </div>

    <table class="ui table striped">
        <thead>
            <tr>
                <th>{{ trans('admin.forms.fields.name') }}</th>
                <th>{{ trans('admin.forms.fields.title') }}</th>
                <th>{{ trans('admin.common.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($forms as $form)
            <tr>
                <td>{{ $form->name }}</td>
                <td>{{ $form->title }}</td>
                <td>{{ $form->created_at }}</td>
                <td class="actions right aligned">
                    <a href="{{ route('forms.edit', $form->id) }}" class="ui button"><i class="write icon"></i></a>
                    {!! Form::delete(route('forms.destroy', $form->id)) !!}
                </td>
            </tr>
            @empty
            <tr>
                <td class="empty" colspan="4">{{ trans('admin.forms.empty') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
