<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefuelingCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_time' => 'required|date',
            'km_operating_hour' => 'required|numeric',
            'trip1' => 'required|numeric',
            'refueled_quantity' => 'required|numeric',
            'fuel_cost' => 'required|numeric',
            'refuelling_cost' => 'required|numeric',
            'average_consumption' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'date_time.required' => "A tankolás időpontjának kitöltése kötelező!",
            'date_time.date' => "A tankolás időpontjának dátum típusúnak kell lennie!",

            'km_operating_hour.required'=> "A km vagy az üzemóra megadása kötelező!",
            'km_operating_hour.numeric'=> "A km-nek vagy az üzemórának szám formátumúnak kell lennie!",

            'trip1.required'=> "Az napi számláló 1 kitöltése kötelező, mivel ebből számolódik az átlagfogyasztás!",
            'trip1.numeric'=> "Az napi számláló 1-nek szám formátumúnak kell lennie!",

            'refueled_quantity.required'=> "A tankolási mennyiség megadása kötelező!",
            'refueled_quantity.numeric'=> "A tankolási mennyiségnek szám formátumúnak kell lennie!",

            'fuel_cost.required'=> "Az üzemanyag egységárának megadása kötelező!",
            'fuel_cost.numeric'=> "Az üzemanyag egységárának szám formátumúnak kell lennie!",

            'refuelling_cost.required'=> "A tankolási költség megadása kötelező!",
            'refuelling_cost.numeric'=> "A tankolási költségnek szám formátumúnak kell lennie!",

            'average_consumption.required'=> "Az átlagfogyasztás megadása kötelező!",
            'average_consumption.numeric'=> "Az átlagfogyasztásnak szám formátumúnak kell lennie!",
        ];
    }
}
