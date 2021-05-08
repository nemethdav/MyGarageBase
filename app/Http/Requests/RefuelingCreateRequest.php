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
            'vehicle_id' => 'required',
            'date_time' => 'required|date',
            'km_operating_hour' => 'required|numeric|min:0',
            'trip1' => 'required|numeric|min:0',
            'refueled_quantity' => 'required|numeric|min:0',
            'fuel_cost' => 'required|numeric|min:0',
            'refuelling_cost' => 'required|numeric|min:0',
            'average_consumption' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required' => "A jármű kiválasztása kötelező!",

            'date_time.required' => "A tankolás időpontjának kitöltése kötelező!",
            'date_time.date' => "A tankolás időpontjának dátum típusúnak kell lennie!",

            'km_operating_hour.required'=> "A km vagy az üzemóra megadása kötelező!",
            'km_operating_hour.numeric'=> "A km-nek vagy az üzemórának szám formátumúnak kell lennie!",
            'km_operating_hour.min' => 'A km van üzemóra érték csak pozitív érték lehet!',

            'trip1.required'=> "Az napi számláló 1 kitöltése kötelező, mivel ebből számolódik az átlagfogyasztás!",
            'trip1.numeric'=> "Az napi számláló 1-nek szám formátumúnak kell lennie!",
            'trip1.min'=> "Az napi számláló 1 csak pozitív érték lehet!",

            'refueled_quantity.required'=> "A tankolási mennyiség megadása kötelező!",
            'refueled_quantity.numeric'=> "A tankolási mennyiségnek szám formátumúnak kell lennie!",
            'refueled_quantity.min'=> "A tankolási mennyiség csak pozitív érték lehet!",

            'fuel_cost.required'=> "Az üzemanyag egységárának megadása kötelező!",
            'fuel_cost.numeric'=> "Az üzemanyag egységárának szám formátumúnak kell lennie!",
            'fuel_cost.min'=> "Az üzemanyag egységára csak pozitív érték lehet!",

            'refuelling_cost.required'=> "A tankolási költség megadása kötelező!",
            'refuelling_cost.numeric'=> "A tankolási költségnek szám formátumúnak kell lennie!",
            'refuelling_cost.min'=> "A tankolási költség csak pozitív érték lehet!",

            'average_consumption.required'=> "Az átlagfogyasztás megadása kötelező!",
            'average_consumption.numeric'=> "Az átlagfogyasztásnak szám formátumúnak kell lennie!",
            'average_consumption.min'=> "Az átlagfogyasztás csak pozitív érték lehet!",
        ];
    }
}
