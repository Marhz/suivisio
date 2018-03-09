<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return $this->user()->can('create', $this->user());
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
                    'numeroCandidat' => 'numeric',
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
