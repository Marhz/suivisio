<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Group;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Group::class);
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
                    'name' => 'required|unique:groups,name|max:255',
                    'deadline' => 'date',
                    'year' => 'required|numeric',
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required',
                    Rule::unique('groups')->ignore($this->route()->parameters['id']),
                    'year' => 'required|numeric',
                    'deadline' => 'date',
                ];
            }
        }
        return [
            //
        ];
    }
}
