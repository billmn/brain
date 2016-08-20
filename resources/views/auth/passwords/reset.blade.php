@extends('auth.main')

@section('title', trans('admin.auth.reset.title'))

@section('content')
    {!! Form::open(['url' => 'password/reset', 'class' => 'ui form auth-reset']) !!}
        <h1 class="ui teal header">{{ trans('admin.auth.reset.title') }}</h1>

        {!! Form::errors(['title' => false]) !!}

        {!! Form::hidden('token', $token) !!}

        <div class="field">
            {!! Form::label(trans('admin.auth.reset.email')) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.auth.reset.password')) !!}
            {!! Form::password('password') !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.auth.reset.password_confirmation')) !!}
            {!! Form::password('password_confirmation') !!}
        </div>

        <div class="buttons">
            <button class="stacked fluid ui teal button" type="submit">
                {{ trans('admin.auth.reset.reset') }}
            </button>

            <a class="fluid ui button" href="{{ url('/login') }}">
                {{ trans('admin.auth.reset.login') }}
            </a>
        </div>
    {!! Form::close() !!}
@endsection
