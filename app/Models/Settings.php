<?php

namespace App\Models;

class Settings extends BaseModel
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'value' => 'array',
    ];

    /**
     * Temp Value accessor (Bug: https://github.com/laravel/framework/issues/13582).
     *
     * @param  mixed $value
     * @return mixed
     */
    public function getValueAttribute($value)
    {
        return $this->fromJson($value);
    }
}
