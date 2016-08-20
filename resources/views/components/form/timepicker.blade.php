<?php
    if (isset($options['class'])) {
        $options['class'] .= ' timepicker';
    } else {
        $options['class'] = 'timepicker';
    }
?>

<div class="ui icon input field-timepicker">
    {!! Form::text($name, $value, $options) !!}
    <i class="wait icon"></i>
</div>
