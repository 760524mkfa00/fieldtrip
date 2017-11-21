<?php

namespace Fieldtrip\Http\Requests;

use Fieldtrip\Rules\YesNo;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
            'employee_number' => ['required', 'max:20', Rule::unique('users')->ignore(request()->user->id)],
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => ['required','email','max:255', Rule::unique('users')->ignore(request()->user->id)],
            'role' => 'required|exists:roles,id', // validating role
            'route_number' => 'exists:routes,id',
            "active" => ['required', new YesNo]
        ];
    }
}
