<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;

class Message extends BaseModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id',
        'form_name',
        'email',
        'fields',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'fields' => 'object',
    ];
}
