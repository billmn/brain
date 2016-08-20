<?php

namespace App\Models;

use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MenuItem extends BaseModel implements Sortable
{
    use SortableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus_items';

    /**
     * Available types.
     */
    const TYPE_LINK = 'link';
    const TYPE_PAGE = 'page';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'type',
        'label',
        'value',
        'page_id',
        'sublevels',
        'order_column',
        'visible_from',
        'visible_to',
    ];

    /**
     * Available Page Status.
     *
     * @return array
     */
    public function getTypeList()
    {
        return [
            self::TYPE_LINK     => trans('admin.menus_items.types.'.self::TYPE_LINK),
            self::TYPE_PAGE   => trans('admin.menus_items.types.'.self::TYPE_PAGE),
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
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS AND MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_slug($value, '_');
    }
}
