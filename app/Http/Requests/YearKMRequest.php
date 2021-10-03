<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YearKMRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vehicle_id' => ['required'],
            'year' => ['required'],
            'start_km_operating_hour' => ['required', 'min:0'],
            'end_km_operating_hour' => ['min:0'],
            'year_km_operating_hour' => ['min:0']
         ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required' => 'A kiválasztása kötelező!',

            'year.required' => 'Az év megadása közelező!',

            'start_km_operating_hour.required' => 'A kezdő km/üzemóra megadása közelező!',

            'start_km_operating_hour.min' => 'Az év eleji km/üzemóra nem lehet negatív szám',

            'end_km_operating_hour.min' => 'A ez év végi km/üzemóra nem lehet negatív szám',

            'year_km_operating_hour.min' => 'A megtett km/üzemóra nem lehet negatív szám',

        ];
    }
}
