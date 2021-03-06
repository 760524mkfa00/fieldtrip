<?php

namespace Fieldtrip\Http\Requests;

use Carbon\Carbon;
use Fieldtrip\Rules\Contains;
use Fieldtrip\Trip;
use Illuminate\Foundation\Http\FormRequest;

class StoreResponse extends FormRequest
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
            'response' => ['required', new Contains]
        ];
    }

    public function persist($id)
    {
        $trip = New Trip();

        $data = \DB::table('trip_user')
            ->where('id', $id)
            ->first();

        $data->response = $this->input('response');
        $data->response_time = Carbon::now()->format('Y-m-d H:i:s');

        $array = json_decode(json_encode($data), true);

        $trip->storeUserTrip($id, $array);

        return [$this->get('trip_id'),$this->get('user_id')];

    }
}
