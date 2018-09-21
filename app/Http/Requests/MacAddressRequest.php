<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class MacAddressRequest extends FormRequest
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
        return ['address' => 'required|regex:/^([0-9A-Fa-f]{2}[:]){5}([0-9A-Fa-f]{2})$/'];
    }

    public function messages()
    {
        return ['address.regex' => 'L\'adresse doit être composée de 6 blocs de deux chiffres hexadécimaux séparés par des ":".'];
    }

}
