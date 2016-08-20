@extends('admin.main')

@section('title', trans('admin.forms_fields.title'))
@section('menu', false)
@section('sidebar', false)

@section('main')
    @if ($field->exists)
        {!! Form::model($field, ['route' => ['forms.fields.update', $form, $field], 'method' => 'PUT', 'class' => 'ui form']) !!}
    @else
        {!! Form::model($field, ['route' => ['forms.fields.store', $form], 'class' => 'ui form']) !!}
    @endif

    <div class="ui top fixed menu">
        <div class="header item">{{ ucfirst(trans('admin.forms_fields.sing')) }}</div>

        <div class="right menu">
            <button class="item primary" type="submit">
                <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
            </button>
        </div>
    </div>

    <div class="modal-content with-menu">
        {!! Form::hidden('form_id', $form->id) !!}

        {!! Form::errors() !!}

        <div class="two fields">
            <div class="field">
                {!! Form::label(trans('admin.forms_fields.fields.type')) !!}
                {!! Form::select('type', $typeList) !!}
            </div>
            <div class="field">
                {!! Form::label(trans('admin.forms_fields.fields.label')) !!}
                {!! Form::text('label', null, ['autofocus' => true]) !!}
            </div>
        </div>

        <div class="ui top attached tabular menu" data-cookie="admin_form_field_tab">
            <a class="item active" data-tab="info">{{ trans('admin.forms_fields.tabs.info') }}</a>
            <a class="item" data-tab="options">{{ trans('admin.forms_fields.tabs.options') }}</a>
            <a class="item" data-tab="rules">{{ trans('admin.forms_fields.tabs.rules') }}</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="info">
            <div class="two fields">
                <div class="field">
                    {!! Form::label(trans('admin.forms_fields.fields.name')) !!}
                    {!! Form::text('name', null, ['placeholder' => 'Leave empty to autogenerate ...']) !!}
                </div>
                <div class="field">
                    {!! Form::label(trans('admin.forms_fields.fields.value')) !!}
                    {!! Form::text('value') !!}
                </div>
            </div>

            <div class="field">
                {!! Form::label(trans('admin.forms_fields.fields.description')) !!}
                {!! Form::wysi('description') !!}
            </div>
        </div>

        <div class="ui bottom attached tab segment" data-tab="options">
            <div class="field">
                {!! Form::label(trans('admin.forms_fields.fields.options')) !!}
                {!! Form::textarea('options') !!}
            </div>
        </div>

        <div class="ui bottom attached tab segment" data-tab="rules">
            <div class="field">
                {!! Form::label(trans('admin.forms_fields.fields.rules')) !!}
                {!! Form::text('rules') !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection
