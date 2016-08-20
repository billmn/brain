@extends('auth.main')

@section('title', trans('admin.auth.forgot.title'))

@section('content')
    {!! Form::open(['url' => 'password/email', 'class' => 'ui form auth-forgot']) !!}
        <h1 class="ui teal header">{{ trans('admin.auth.forgot.title') }}</h1>

        {!! Form::errors(['title' => false]) !!}

        <div class="field">
            {!! Form::label(trans('admin.auth.forgot.email')) !!}
            {!! Form::email('email', null, ['autofocus' => true]) !!}
        </div>

        <div class="buttons">
            <button class="stacked fluid ui teal button" type="submit">
                {{ trans('admin.auth.forgot.send') }}
            </button>

            <a class="fluid ui button" href="{{ url('/login') }}">
                {{ trans('admin.auth.forgot.login') }}
            </a>
        </div>
    {!! Form::close() !!}
@endsection
