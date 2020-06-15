<?php

namespace App\Http\Requests;

use App\Rules\RegexRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryValidationRequest extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:23',
                'unique:categories,name,' . $this->id . ',id',
            ],
        ];
    }

    /*
     * Custom message for validation.
     *
     * @return array
     */

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
        ];
    }
}
