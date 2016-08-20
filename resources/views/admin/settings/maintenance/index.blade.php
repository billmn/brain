@extends('admin.main')

@section('title', trans('admin.settings.title'))

@section('content')
    {!! Form::model($settings, ['class' => 'ui form']) !!}
        @include('admin.settings.menu')

        <div class="field">
            {!! Form::label(trans('admin.settings.maintenance.fields.status')) !!}
            {!! Form::select('maintenance[status]', $statusList) !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.maintenance.fields.title')) !!}
            {!! Form::text('maintenance[title]') !!}
        </div>

        <div class="field">
            {!! Form::label(trans('admin.settings.maintenance.fields.content')) !!}
            {!! Form::wysi('maintenance[content]') !!}
        </div>

        <button class="ui button primary" type="submit">
            <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
        </button>
    {!! Form::close() !!}
@endsection
