<div class="ui action input field-image">
    <?php
        $type = array_get($options, 'type', 'all');
        $append = array_get($options, 'append', 0);
        $multiple = array_get($options, 'multiple', 0);

        array_forget($options, ['type', 'multiple']);
    ?>

    {!! Form::text($name, $value, $options) !!}

    <a href="javascript:;" class="ui icon teal button modal-files" tabindex="-1"
            data-type="{{ $type }}"
            data-append="{{ $append }}"
            data-inputid="{{ $name }}"
            data-multiple="{{ $multiple }}">
        <i class="image icon"></i>
    </a>
</div>
