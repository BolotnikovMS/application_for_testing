<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'surname' => 'required|min:2|max:60',
            'name' => 'required|min:2|max:60',
            'lastname' => 'required|min:2|max:60',
            'group' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'surname.required' => 'Поле фамилия пользователя является обязательным!',
            'surname.min' => 'Поле фамилия пользователя должно быть больше 2-х символов!',
            'surname.max' => 'Поле фамилия пользователя должно быть меньше 60-и символов!',
            'name.required' => 'Поле имя пользователя является обязательным!',
            'name.min' => 'Поле имя пользователя должно быть больше 2-х символов!',
            'name.max' => 'Поле имя пользователя должно быть меньше 60-и символов!',
            'lastname.required' => 'Поле отчество пользователя является обязательным!',
            'lastname.min' => 'Поле отчество пользователя должно быть больше 2-х символов!',
            'lastname.max' => 'Поле отчество пользователя должно быть меньше 60-и символов!',
            'group.required' => 'Поле группа является обязательным!'
        ];
    }
}
