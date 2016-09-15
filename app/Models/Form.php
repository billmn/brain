<?php

namespace App\Models;

class Form extends BaseModel
{
    /**
     * Available types.
     */
    const TYPE_PAGE = 'page';
    const TYPE_CONTACT = 'contact';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'enabled',
        'type',
        'name',
        'title',
        'description',
        'success_message',
        'success_email',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'success_email' => 'object',
    ];

    /**
     * Available Page Status.
     *
     * @return array
     */
    public function getTypeList()
    {
        return [
            self::TYPE_PAGE => trans('admin.forms.types.'.self::TYPE_PAGE),
            self::TYPE_CONTACT => trans('admin.forms.types.'.self::TYPE_CONTACT),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /**
     * Form fields.
     *
     * @return \App\Models\FormField
     */
    public function fields()
    {
        return $this->hasMany(FormField::class)->ordered();
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * Scope a query to only include visible forms.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->where('enabled', true);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS AND MUTATORS
    |--------------------------------------------------------------------------
    */

    /**
     * Get form action URL.
     *
     * @return string
     */
    public function getActionAttribute()
    {
        return route('message.register', $this->id);
    }
}
