@extends('admin.main')

@section('title', trans('admin.settings.users.title'))

@section('content')
    @if ($user->exists)
        {!! Form::model($user, ['route' => ['settings.users.update', $user->id], 'method' => 'PUT', 'class' => 'ui form']) !!}
    @else
        {!! Form::model($user, ['route' => 'settings.users.store', 'class' => 'ui form']) !!}
    @endif

        @include('admin.settings.menu')

        {!! Form::errors() !!}

        <div class="field">
            {!! Form::label(trans('admin.settings.users.fields.name')) !!}
            {!! Form::text('name', null, ['autofocus' => true]) !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.users.fields.email')) !!}
            {!! Form::email('email') !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.users.fields.password')) !!}
            {!! Form::password('password') !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.users.fields.password_confirmation')) !!}
            {!! Form::password('password_confirmation') !!}
        </div>

        <a class="ui button" href="{{ route('settings.users.index') }}">
            <i class="angle left icon"></i> {{ trans('admin.actions.back') }}
        </a>

        <button class="ui button primary" type="submit">
            <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
        </button>
    {!! Form::close() !!}
@endsection
