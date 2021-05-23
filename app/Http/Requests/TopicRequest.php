<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicRequest extends FormRequest
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
            'name' => 'required|min:2|max:60'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле название является обязательным!',
            'name.min' => 'Поле название должно быть больше 2-х символов!',
            'name.max' => 'Поле название должно быть меньше 60-и символов!'
        ];
    }
}
