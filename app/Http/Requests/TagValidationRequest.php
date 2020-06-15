<?php

namespace App\Http\Requests;

use App\Rules\RegexRule;
use Illuminate\Foundation\Http\FormRequest;

class TagValidationRequest extends FormRequest
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
                'required', new RegexRule('/(^[A-Za-z0-9-]+$)+/'),
                'min:3',
                'max:25',
                'unique:tags,name,' . $this->id . ',id',
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
