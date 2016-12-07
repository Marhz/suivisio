<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST':
            {
                return [
                    'first_name' => 'required|between:2,255|alpha',
                    'last_name' => 'required|between:2,255|alpha',
                    'email' => 'required|email|unique:users,email',
                ];
            }
            case 'PUT':
            {
                return [
                    'email' => 'required|email|max:255',Rule::unique('users')->ignore($id),
                    'last_name' => 'required|between:2,255|alpha',
                    'first_name' => 'required|between:2,255|alpha',
                ];
            }
        }
    }
}
