@extends('admin.main')

@section('title', trans('admin.labels.title'))

@section('content')
<div id="labels_cont" class="ui basic segment">
    {!! Form::model($values, ['class' => 'ui small form']) !!}
        <table class="ui fixed table striped">
            <thead>
                <tr>
                    <th>{{ trans('admin.labels.fields.name') }}</th>
                    <th>{{ trans('admin.labels.fields.value') }}</th>
                    <th>{{ trans('admin.labels.fields.code') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($labels as $name => $info)
                    <tr>
                        <td>
                            {{ array_get($info, 'label') }}
                            <br />

                            @if (isset($info['descr']))
                                <small>{{ $info['descr'] }}</small>
                            @endif
                        </td>
                        <td class="field">
                            @if (array_get($info, 'type') == 'textarea')
                                {!! Form::textarea($name) !!}
                            @else
                                {!! Form::text($name) !!}
                            @endif
                        </td>
                        <td>
                            <code>{{ $name }}</code>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ trans('admin.labels.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (count($labels))
            <button class="ui button primary" type="submit">
                <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
            </button>
        @endif
    {!! Form::close() !!}
</div>
@endsection
