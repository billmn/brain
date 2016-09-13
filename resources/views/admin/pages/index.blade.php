@extends('admin.main')

@section('title', trans('admin.pages.title'))

@section('content')
<div id="pages_cont" class="ui basic segment">
    <div class="ui menu">
        <a class="green item" href="{{ route('pages.create') }}">
            <i class="plus icon"></i>
            {{ trans('admin.actions.create') }} {{ trans('admin.pages.sing') }}
        </a>
    </div>

    <div id="tree" class="tree-cont block-style"></div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function() {
    var $tree = $('#tree').tree({
        dataUrl: "{{ route('pages.index') }}",
        autoOpen: true,
        saveState: true,
        dragAndDrop: true,
        onCreateLi: function(node, $li) {
            var url = {
                edit: "{{ route('pages.edit', 0) }}",
                create: "{{ route('pages.create') }}",
                destroy: "{{ route('pages.destroy', 0) }}"
            };

            $li.find('.jqtree-element').append(
                '<div class="actions">\
                    <a href="' + url.create + '?parent_id=' + node.id + '" class="ui green button" data-node-id="'+ node.id  +'"><i class="plus icon"></i></a>\
                    <a href="' + url.edit.replace(0, node.id) + '" class="ui button" data-node-id="'+ node.id  +'"><i class="write icon"></i></a>\
                    <a href="' + url.destroy.replace(0, node.id) + '" class="ui red button btn-destroy" data-node-id="'+ node.id  +'"><i class="delete icon"></i></a>\
                </div>'
            );
        }
    });

    $tree.bind('tree.move', function(event) {
        var moved = event.move_info.moved_node;
        var target = event.move_info.target_node;
        var position = event.move_info.position;

        if (position == 'inside' && target.hasChildren() && target.children.length >= 1) {
            position = 'before';
            target = target.children[0];
        }

        $.ajax({
            url: "{{ route('pages.move') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                moved: moved.id,
                target: target.id,
                position: position
            }
        });
    });

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
})
</script>
@endsection
