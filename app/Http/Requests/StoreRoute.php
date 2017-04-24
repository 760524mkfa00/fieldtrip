<?php

namespace Fieldtrip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoute extends FormRequest
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
            'zone_id' => 'required|exists:zones,id',
            'route_number' => 'required|min:1|unique:routes',
            'end_time_am' => 'required',
            'end_point_am' => 'required',
            'start_time_pm' => 'required',
            'start_point_pm' => 'required',
            'end_time_pm' => 'required',
        ];
    }
}
