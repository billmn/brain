<?php

namespace App\Http\Requests;

use App\Repositories\MenuRepository;
use Illuminate\Foundation\Http\FormRequest;

class MenuItemUpdateRequest extends FormRequest
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
            'menu_id'   => 'required',
            'type'      => "required|in:{$types}",
            'label'     => 'required_if:type,link',
            'sublevels' => 'integer|min:0',
        ];
    }
}
