@extends('admin.main')

@section('title', trans('admin.messages.title'))
@section('menu', false)
@section('sidebar', false)

@section('main')
    <div class="ui top fixed menu">
        <div class="header item">{{ ucfirst(trans('admin.messages.sing')) }}</div>
    </div>

    <div class="modal-content with-menu">
        <h2 class="ui header">
            <i class="mail icon"></i>

            <div class="content">
                {{ $message->form_name }}

                <div class="sub header">
                    <a href="mailto:{{ $message->email }}">{{ $message->email }}</a> - {{ $message->created_at }}
                </div>
            </div>
        </h2>

        <div class="ui divider"></div>

        <table class="ui definition table">
            <tbody>
                @foreach($message->fields as $field)
                    <tr>
                        <td class="two wide column">{{ $field->label }}</td>
                        <td>{{ $field->input }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
