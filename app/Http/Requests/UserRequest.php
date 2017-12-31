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

        return \Auth::user()->can('create', \User::class());
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
                    'first_name' => 'required|between:2,255|',
                    'last_name' => 'required|between:2,255|',
                    'email' => 'required|email|unique:users,email',
                ];
            }
            case 'PUT':
            {
                return [
                    'email' => 'required|email|max:255',
                    Rule::unique('users')->ignore($this->route()->parameters['id']),
                    'last_name' => 'required|between:2,255|',
                    'first_name' => 'required|between:2,255|',
                ];
            }
        }
        return [];
    }
}
