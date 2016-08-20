<?php
    if (isset($options['class'])) {
        $options['class'] .= ' datepicker';
    } else {
        $options['class'] = 'datepicker';
    }
?>

<div class="ui icon input field-datepicker">
    {!! Form::text($name, $value, $options) !!}
    <i class="calendar outline icon"></i>
</div>
