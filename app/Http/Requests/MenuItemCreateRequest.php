<?php

namespace App\Http\Requests;

use App\Repositories\MenuRepository;

class MenuItemCreateRequest extends Request
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
        $types = app(MenuRepository::class)->getItemTypeList();
        $types = implode(',', array_keys($types));

        return [
            'menu_id' => 'required',
            'type'    => "required|in:{$types}",
            'label'   => 'required',
        ];
    }
}
