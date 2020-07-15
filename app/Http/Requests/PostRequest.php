<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:20',
            'body' => 'required|max:300',
            'path' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください。',
            'title.max'      => 'タイトルは20文字以内で入力してください。',
            'body.required'  => '本文を入力してください。',
            'body.max'       => '本文は300文字以内で入力してください。',
            'path.required'  => '画像を選択してください。',
            'path.file'      => '画像のタイプが違います。',
        ];
    }
}
