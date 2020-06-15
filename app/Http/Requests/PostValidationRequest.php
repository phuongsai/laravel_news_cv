<?php

namespace App\Http\Requests;

use App\Rules\RegexRule;
use Illuminate\Foundation\Http\FormRequest;

class PostValidationRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'min:3'],
            'testimage' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp|max:10240',
            'categories' => 'required|array|min:1|max:2',
            'tags' => 'required|array|min:1|max:3',
            'body' => 'required',
        ];
    }
}
