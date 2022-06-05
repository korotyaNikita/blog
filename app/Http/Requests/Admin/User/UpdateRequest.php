<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $this->user_id,
            'user_id' => 'required|integer|exists:users,id',
            'role' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Це поле необхідно заповнити',
            'name.string' => 'Ім\'я має відповідати рядковому типу',
            'email.required' => 'Це поле необхідно заповнити',
            'email.string' => 'Пошта має відповідати рядковому типу',
            'email.email' => 'Пошта має відповідати формату example@some.domain',
            'email.unique' => 'Користувач з таким email вже існує',
            'role.required' => 'Це поле неохідно заповнити',
            'role.integer' => 'Значення має бути цілочисельним',
        ];
    }
}
