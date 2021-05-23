<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
            'name' => 'required|min:2|max:80',
            'author' => 'required|min:2|max:70',
            'number' => 'required',
            'testtime' => 'required',
            'group' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'discipline.required' => 'Поле дисциплина является обязательным!',
            'topic.required' => 'Поле тема является обязательным!',
            'name.required' => 'Поле название теста является обязательным!',
            'name.min' => 'Поле название теста должно быть больше 2-х символов!',
            'name.max' => 'Поле название теста должно быть меньше 80-и символов!',
            'author.required' => 'Поле автор теста является обязательным!',
            'author.min' => 'Поле автор теста должно быть больше 2-х символов!',
            'author.max' => 'Поле автор теста быть меньше 70-и символов!',
            'number.required' => 'Поле количество вопросов является обязательным!',
            'testtime.required' => 'Поле время на тест является обязательным!',
            'group.required' => 'Поле группа является обязательным!'
        ];
    }
}
