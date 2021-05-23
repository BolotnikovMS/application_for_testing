<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
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
    public function rules() {
        return [
            'answer' => 'required|min:2'
        ];
    }

    public function messages() {
        return [
            'answer.required' => 'Не заполнено поле "Ответа"',
            'answer.min' => 'Минимальная длина поля ответ 2 символов!'
        ];
    }
}
