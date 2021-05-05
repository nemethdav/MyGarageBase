<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleCreateRequest extends FormRequest
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
    public function rules() {
        return [
            'vehicleNickName' => ['required'],
            'vehicle_type' => ['required', 'min:1', 'max:2'],
            'manufacturer' => ['required', 'min:3', 'max:255'],
            'type' => ['required', 'min:3', 'max:255'],
            'year_of_manufacture' => ['required', 'integer', 'min:1900'],
            'cylinder_capacity' => ['required', 'min:0'],
            'performance_kw' => ['required', 'min:0'],
            'performance_le' => ['required', 'min:0'],
            'date_of_purchase' => ['date'],
        ];
    }

    public function messages() {
        return [
            'vehicleNickName.required' => 'A jármű becenevének megadása kötelező!',
            'vehicle_type.required' => 'A jármű típusának megadása közelező!',
            'vehicle_type.min' => 'A jármű típusa Motorkerékpár vagy Személygépjármű lehet!',
            'vehicle_type.max' => 'A jármű típusa Motorkerékpár vagy Személygépjármű lehet!',

            'manufacturer.required' => 'A jármű gyártójának megadása kötelező!',
            'manufacturer.min' => 'A jármű gyártójának neve minimum 3 karakter hosszú kell lenni!',
            'manufacturer.max' => 'A jármű gyártójának neve maximum 255 karakter hosszú lehet!',

            'type.required' => 'A jármű típusának megadása kötelező!',
            'type.min' => 'A jármű típusa minimum 3 karakter hosszú kell lenni!',
            'type.max' => 'A jármű típusa maximum 255 karakter hosszú lehet!',

            'year_of_manufacture.required' => 'A jármű évjáratának megadása kötelező!',
            'year_of_manufacture.integer' => 'A jármű évjáratának egész számot kell tartalmaznia!',
            'year_of_manufacture.min' => 'A jármű évjárata nem lehet 1900-nál régebbi!',

            'cylinder_capacity.required' => 'A hengerűrtartalom megadása kötelező!',
            'cylinder_capacity.min' => 'A hengerűrtartalom nem lehet negatív!',

            'performance_kw.required' => 'A a jármű teljesítményének (kW) megadása kötelező!',
            'performance_kw.min' => 'A a jármű teljesítménye (kW) nem lehet negatív!',

            'performance_le.required' => 'A jármű teljesítményének (LE) megadása kötelező!',
            'performance_le.min' => 'A jármű teljesítménye (LE) nem lehet negatív!',

            'date_of_purchase.date' => "A vásárlás csak dátum formátumú lehet!"
        ];
    }
}
