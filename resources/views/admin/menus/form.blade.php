@extends('admin.main')

@section('title', trans('admin.menus.title'))

@section('content')
    @if ($menu->exists)
        {!! Form::model($menu, ['route' => ['menus.update', $menu->id], 'method' => 'PUT', 'class' => 'ui form']) !!}
    @else
        {!! Form::model($menu, ['route' => 'menus.store', 'class' => 'ui form']) !!}
    @endif

        {!! Form::errors() !!}

        <div class="field">
            {!! Form::label(trans('admin.menus.fields.name')) !!}
            {!! Form::text('name', null, ['autofocus' => true]) !!}
        </div>

        <div class="ui top attached tabular menu" data-cookie="admin_form_tab">
            <a class="item active" data-tab="info">{{ trans('admin.menus.tabs.info') }}</a>
            <a class="item" data-tab="items">{{ trans('admin.menus.tabs.items') }}</a>
        </div>

        <div class="ui bottom attached tab segment active" data-tab="info">
            <div class="field">
                {!! Form::label(trans('admin.menus.fields.title')) !!}
                {!! Form::text('title') !!}
            </div>

            <div class="field">
                {!! Form::label(trans('admin.menus.fields.description')) !!}
                {!! Form::wysi('description') !!}
            </div>
        </div>

        <div class="ui bottom attached tab segment" data-tab="items">
            <a class="ui green button modal-iframe" href="{{ route('menus.items.create', ['menu' => $menu, 'type' => 'link']) }}">
                <i class="linkify icon"></i> {{ trans('admin.actions.add') }} {{ trans('admin.menus_items.types.link') }}
            </a>

            <a class="ui green button modal-iframe" href="{{ route('menus.items.create', ['menu' => $menu, 'type' => 'page']) }}">
                <i class="file icon"></i> {{ trans('admin.actions.add') }} {{ trans('admin.menus_items.types.page') }}
            </a>

            <div id="fields_tree" class="tree-cont block-style"></div>
        </div>

        <a class="ui button" href="{{ route('menus.index') }}">
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
        dataUrl: "{{ route('menus.items.index', $menu->id) }}",
        dragAndDrop: true,
        onCanMoveTo: function(moved_node, target_node, position) {
            return (position == 'inside') ?
                        moved_node.parent == target_node :
                        moved_node.parent == target_node.parent;
        },
        onCreateLi: function(node, $li) {
            var url = {
                edit: "{{ route('menus.items.edit', [$menu, 0]) }}",
                destroy: "{{ route('menus.items.destroy', [$menu, 0]) }}"
            };

            $li.find('.jqtree-element').append(
                '<div class="actions">\
                    <a href="' + url.edit.replace(0, node.id) + '" class="ui button modal-iframe" data-node-id="'+ node.id  +'"><i class="write icon"></i></a>\
                    <a href="' + url.destroy.replace(0, node.id) + '" class="ui red button btn-destroy" data-node-id="'+ node.id  +'"><i class="delete icon"></i></a>\
                </div>'
            );
        }
    });

    @if ($menu->id)
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
                url: "{{ route('menus.items.move') }}",
                type: 'POST',
                data: {
                    form: {{ $menu->id }},
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
