<?php

namespace App\Http\Requests;

use App\Repositories\FormRepository;
use Illuminate\Foundation\Http\FormRequest;

class FormFieldCreateRequest extends FormRequest
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

        $id = $this->route()->getParameter('field');
        $formId = $this->route()->getParameter('form');

        return [
            'form_id' => 'required',
            'type'    => "required|in:{$types}",
            'label'   => 'required',
            'name'    => "required|unique:forms_fields,name,{$id},id,form_id,{$formId}",
        ];
    }
}
