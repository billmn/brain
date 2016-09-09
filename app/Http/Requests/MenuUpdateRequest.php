<?php

namespace App\Http\Requests;

use App\Repositories\MenuRepository;

class MenuUpdateRequest extends Request
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
        $id = $this->route()->getParameter('menu');

        return [
            'name' => "required|unique:menu,name,{$id}",
        ];
    }
}
