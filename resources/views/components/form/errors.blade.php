@if ($errors->all())
<div class="ui negative message">
    <i class="close icon"></i>
    <div class="header">{{ trans('admin.common.messages.title.error') }}</div>

    @foreach($errors->all() as $error)
    <div class="item">{{ $error }}</div>
    @endforeach
</div>
@endif
