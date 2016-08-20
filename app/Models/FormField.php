<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class FormField extends BaseModel implements Sortable
{
    use SortableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forms_fields';

    /**
     * Available types.
     */
    const TYPE_DATE = 'date';
    const TYPE_TEXT = 'text';
    const TYPE_SELECT = 'select';
    const TYPE_HIDDEN = 'hidden';
    const TYPE_RADIO = 'radio';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_TEXTAREA = 'textarea';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id',
        'type',
        'name',
        'label',
        'value',
        'description',
        'options',
        'rules',
    ];

    /**
     * Available Page Status.
     *
     * @return array
     */
    public function getTypeList()
    {
        return [
            self::TYPE_TEXT     => trans('admin.forms_fields.types.'.self::TYPE_TEXT),
            self::TYPE_SELECT   => trans('admin.forms_fields.types.'.self::TYPE_SELECT),
            self::TYPE_TEXTAREA => trans('admin.forms_fields.types.'.self::TYPE_TEXTAREA),
            self::TYPE_HIDDEN   => trans('admin.forms_fields.types.'.self::TYPE_HIDDEN),
            self::TYPE_DATE     => trans('admin.forms_fields.types.'.self::TYPE_DATE),
            self::TYPE_RADIO    => trans('admin.forms_fields.types.'.self::TYPE_RADIO),
            self::TYPE_CHECKBOX => trans('admin.forms_fields.types.'.self::TYPE_CHECKBOX),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Field's form.
     *
     * @return \App\Models\Form
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS AND MUTATORS
    |--------------------------------------------------------------------------
    */

    public function getOptionsListAttribute()
    {
        if (! $this->options) {
            return [];
        }

        $options = explode("\n", $this->options);

        foreach ($options as $index => $value) {
            $value = trim($value);
            $value = str_contains('|', $value) ? $value : "{$value}|{$value}";
            $option = explode('|', $value);

            $options[$index] = [
                'value' => trim($option[0]),
                'label' => trim($option[1]),
            ];
        }

        return collect($options);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_slug($value, '_');
    }
}
