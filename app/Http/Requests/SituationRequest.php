<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SituationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method())
        {
            case 'DELETE':
            case 'PUT':
            {
                if(\Auth::user()->isAdmin())
                    return true;
                $situation = \App\Situation::findOrFail($this->route()->parameters()['situation']);
                return $situation->user_id == \Auth::user()->id;
            }
            default:
            {
                return true;
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'source_id' => 'required|numeric',
            'activity_list' => 'required|array',
            'begin_at' => 'required|date_format:d/m/Y',
            'end_at' => 'required|date_format:d/m/Y|after:begin_at',
        ];        
    }
}
