<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'title' => 'required|unique:todos|max:30|special'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
     public function messages()
     {
       return [
           'title.required' => '入力必須項目です',
           'title.unique' => 'そのToDo名は既に使われております',
           'title.max' => 'ToDoの名称は30文字以内にしてください',
       ];
     }
}
