<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileValidationRequest extends FormRequest
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
        // skipping check email if it belong to owner
        return [
            'name' => 'required|max:255|min:3',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp|max:2048|dimensions:max_width=512,max_height=512',
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
            'email.required' => 'Email is required!',
        ];
    }
}
