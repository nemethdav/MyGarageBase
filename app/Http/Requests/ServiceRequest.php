<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'vehicle_id' => 'required',
            'service_name' => 'required|min:3',
            'service_title' => 'required|min:3',
            'service_date' => 'required|date',
            'km_operatinghour' => 'required|min:0',
            'description' => 'required|min:10',
            'price' => 'required|min:0'
        ];
    }

    public function messages()
    {
        return [
            'vehicle_id.required' => 'A jármű kiválasztása kötelező!',

            'service_name.required' => 'A szerviz nevének megadása kötelező!',
            'service_name.min' => 'A szerviz nevének minimum 3 betűsnek kell lennie!',

            'service_title.required' => 'A szervizelés megnevezése kötelező!',
            'service_title.min' => 'A szervizelés megnevezésének minimum 3 betűsnek kell lennie!',

            'service_date.required' => 'A szervizelés dátumának megadása kötelező!',
            'service_date.date' => 'A szervizelés dátumának dátum formátumú kell lennie!',

            'km_operatinghour.required' => 'A KM/Üzemóra megadása kötelező!',
            'km_operatinghour.min' => 'Az óraállás nem lehet negatív szám!',

            'description.required' => 'A szervizelés leírása kötelező',
            'description.min' => 'A szervizelés leírásának minimum 10 karakter hosszúnak kell lennie!',

            'price.required' => 'A szervizelés költségének megadása kötelező!',
            'price.min' => 'A szervizelés költsége nem lehet negatív!'
        ];
    }
}
