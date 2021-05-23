<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'discipline' => 'required',
            'topic' => 'required',
            'description' => 'required|min:10'
        ];
    }

    public function messages() {
        return [
            'discipline.required' => 'Не выбрана дисциплина!',
            'topic.required' => 'Не выбрана тема!',
            'description.required' => 'Не заполнено поле "Формулировка вопроса"',
            'description.min' => 'Минимальная длина формулировки 10 символов!',
            'answer.required' => 'Не заполнено поле "Ответа"',
            'answer.min' => 'Минимальная длина поля ответ 5 символов!'
        ];
    }
}
