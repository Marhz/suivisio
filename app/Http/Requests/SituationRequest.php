<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Situation;
use Auth;

class SituationRequest extends FormRequest
{
    public function authorize(){return true;}

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
