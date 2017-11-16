<?php

namespace Fieldtrip\Http\Requests;

use Fieldtrip\Rules\YesNo;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHours extends FormRequest
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
            "one" => 'required|numeric|between:0,100',
            "oneHalf" => 'required|numeric|between:0,100',
            "two" => 'required|numeric|between:0,100',
            "mileage" => 'required|numeric|between:0,1000',
            "bank" => ['required', new YesNo]
        ];
    }

    public function persist($id)
    {

        $data = $this->only('one', 'oneHalf', 'two', 'mileage', 'bank');
        $data['hours_submitted'] = '1';

        \DB::table('trip_user')
            ->where('id', $id)
            ->update($data);

        return true;

    }
}
