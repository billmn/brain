@extends('admin.main')

@section('title', trans('admin.forms.title'))

@section('content')
    @if ($form->exists)
        {!! Form::model($form, ['route' => ['forms.update', $form->id], 'method' => 'PUT', 'class' => 'ui form']) !!}
    @else
        {!! Form::model($form, ['route' => 'forms.store', 'class' => 'ui form']) !!}
    @endif

        {!! Form::errors() !!}
        {!! Form::hidden('type', App\Models\Form::TYPE_CONTACT) !!}

        <div class="field">
            {!! Form::label(trans('admin.forms.fields.name')) !!}
            {!! Form::text('name', null, ['autofocus' => true]) !!}
        </div>

        <div class="field">
            <div class="ui checkbox">
                {!! Form::checkbox('enabled', true) !!}
                <label>{{ trans('admin.forms.fields.enabled') }}</label>
            </div>
        </div>

        @if ($form->exists)
            <div class="ui top attached tabular menu" data-cookie="admin_form_tab">
                <a class="item active" data-tab="info">{{ trans('admin.forms.tabs.info') }}</a>
                <a class="item" data-tab="fields">{{ trans('admin.forms.tabs.fields') }}</a>
            </div>

            <div class="ui bottom attached tab segment active" data-tab="info">
                <div class="field">
                    {!! Form::label(trans('admin.forms.fields.title')) !!}
                    {!! Form::text('title') !!}
                </div>

                <div class="field">
                    {!! Form::label(trans('admin.forms.fields.description')) !!}
                    {!! Form::wysi('description') !!}
                </div>
            </div>

            <div class="ui bottom attached tab segment" data-tab="fields">
                <a class="ui green button modal-iframe" href="{{ route('forms.fields.create', $form) }}">
                    <i class="plus icon"></i> {{ trans('admin.actions.add') }} {{ trans('admin.forms_fields.sing') }}
                </a>

                <div id="fields_tree" class="tree-cont block-style"></div>
            </div>
        @endif

        <a class="ui button" href="{{ route('forms.index') }}">
            <i class="angle left icon"></i> {{ trans('admin.actions.back') }}
        </a>

        <button class="ui button primary" type="submit">
            <i class="checkmark icon"></i> {{ trans('admin.actions.save') }}
        </button>
    {!! Form::close() !!}
@endsection

@section('scripts')
<script type="text/javascript">
$(function() {
    var $tree = $('#fields_tree').tree({
        dataUrl: "{{ route('forms.fields.index', $form->id) }}",
        dragAndDrop: true,
        onCanMoveTo: function(moved_node, target_node, position) {
            return (position == 'inside') ?
                        moved_node.parent == target_node :
                        moved_node.parent == target_node.parent;
        },
        onCreateLi: function(node, $li) {
            if (node.realname == 'email') {
                return;
            }

            var url = {
                edit: "{{ route('forms.fields.edit', [$form, 0]) }}",
                destroy: "{{ route('forms.fields.destroy', [$form, 0]) }}"
            };

            $li.find('.jqtree-element').append(
                '<div class="actions">\
                    <a href="' + url.edit.replace(0, node.id) + '" class="ui button modal-iframe" data-node-id="'+ node.id  +'"><i class="write icon"></i></a>\
                    <a href="' + url.destroy.replace(0, node.id) + '" class="ui red button btn-destroy" data-node-id="'+ node.id  +'"><i class="delete icon"></i></a>\
                </div>'
            );
        }
    });

    @if ($form->id)
        $tree.bind('tree.move', function(event) {
            var nodes = [];

            // When you handle the tree.move event, the node is not moved yet in the tree.
            // You must call preventDefault to prevent doing the move twice.
            event.preventDefault();
            event.move_info.do_move();

            $.each($tree.tree('getTree').getData(), function(index, node) {
                nodes.push(node.id);
            });

            $.ajax({
                url: "{{ route('forms.fields.move') }}",
                type: 'POST',
                data: {
                    form: {{ $form->id }},
                    nodes: JSON.stringify(nodes),
                    _token: '{{ csrf_token() }}'
                }
            });
        });
    @endif

    $tree.on('click', '.btn-destroy', function(e) {
        e.preventDefault();

        var node = $tree.tree('getNodeById', $(this).data('node-id'));
        var action = $(this).attr('href');

        swal({
            text: trans.dialog.confirm.text,
            title: trans.dialog.confirm.title,
            showCancelButton: true
        }, function() {
            $.ajax({
                url: action,
                type: 'DELETE',
                data: { _token: "{{ csrf_token() }}" },
                success: function(id) {
                    $tree.tree('removeNode', node);
                }
            });
        });
    });

    $.magnificPopup.instance.close = function () {
        $tree.tree('reload');
        $.magnificPopup.proto.close.call(this);
    };
})
</script>
@endsection
