<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'email' => 'required|email|max:255',
            'name' => 'required|max:255',
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
            'name.required' => 'A :attribute is required',
            'name.max'  => ':attribute more then 255 characters',
            'email.required'  => 'A :attribute is required',
            'email.email'  => ':attribute is not valid email',
            'email.max'  => ':attribute more then 255 characters',
        ];
    }
}
