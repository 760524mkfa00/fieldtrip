<?php

namespace Fieldtrip\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDriverHours extends FormRequest
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
            "accepted_hours" => 'required|numeric|between:0,100',
            "declined_hours" => 'required|numeric|between:0,100',
            "one" => 'required|numeric|between:0,100',
            "oneHalf" => 'required|numeric|between:0,100',
            "two" => 'required|numeric|between:0,100',
            "mileage" => 'required|numeric|between:0,1000',
            "unit" => 'required'
        ];
    }
}
