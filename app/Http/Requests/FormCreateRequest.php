<?php

namespace App\Http\Requests;

use App\Repositories\FormRepository;
use Illuminate\Foundation\Http\FormRequest;

class FormCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $types = app(FormRepository::class)->getTypeList();
        $types = implode(',', array_keys($types));

        return [
            'type'  => "required|in:{$types}",
            'name'  => 'required|unique:forms',
        ];
    }
}
