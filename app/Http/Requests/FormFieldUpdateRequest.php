<?php

namespace App\Http\Requests;

use App\Repositories\FormRepository;

class FormFieldUpdateRequest extends Request
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
        $types = app(FormRepository::class)->getFieldTypeList();
        $types = implode(',', array_keys($types));

        return [
            'form_id' => 'required',
            'type'    => "required|in:{$types}",
            'label'   => 'required',
        ];
    }
}
