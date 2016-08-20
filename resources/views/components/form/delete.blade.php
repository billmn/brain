{!! Form::open(['url' => $url, 'method' => 'DELETE', 'class' => 'ui inline form']) !!}
    <button type="submit" title="{{ trans('app.actions.delete') }}" class="ui red button" data-confirm="{{ $confirm }}">
        <i class="delete icon"></i>
    </button>
{!! Form::close() !!}
