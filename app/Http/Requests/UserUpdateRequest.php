<?php

namespace App\Http\Requests;

class UserUpdateRequest extends Request
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
        $id = $this->route()->getParameter('users');

        return [
            'name'     => 'required|max:255',
            'email'    => "required|email|max:255|unique:users,id,{$id}",
            'password' => 'min:6|confirmed',
        ];
    }
}
