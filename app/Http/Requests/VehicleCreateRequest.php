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
//    public function authorize()
//    {
//        return auth()->check();
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'vehicleNickName' => ['min:3', 'max:255'],
            'manufacturer' => ['required', 'min:3', 'max:255'],
            'type' => ['required', 'min:3', 'max:255'],
            'year_of_manufacture' => ['require', 'integer'],
            'cylinder_capacity' => ['require'],
            'performance_kw' => ['require'],
            'performance_le' => ['require'],
            'validity_of_technical_Examination' => ['date'],
        ];
    }

    public function messages() {
        return [
            'vehicleNickName.min' => 'A jármű becenevének minimum 3 karakter hosszú kell lenni!',
            'vehicleNickName.max' => 'A jármű beceneve maximum 255 karakter hosszú lehet!',

            'manufacturer.required' => 'A jármű gyártójának megadása kötelező!',
            'manufacturer.min' => 'A jármű gyártójának neve minimum 3 karakter hosszú kell lenni!',
            'manufacturer.max' => 'A jármű gyártójának neve maximum 255 karakter hosszú lehet!',

            'type.required' => 'A jármű típusának megadása kötelező!',
            'type.min' => 'A jármű típusa minimum 3 karakter hosszú kell lenni!',
            'type.max' => 'A jármű típusa maximum 255 karakter hosszú lehet!',

            'year_of_manufacture.require' => 'A jármű évjáratának megadása kötelező!',
            'year_of_manufacture.integer' => 'A jármű évjáratának egész számot kell tartalmaznia!',

            'cylinder_capacity' => 'A hengerűrtartalom megadása kötelező!',

            'performance_kw' => 'A a jármű teljesítményének (KW) megadása kötelező!',

            'performance_le' => 'A jármű teljesítményének (LE) megadása kötelező!',

            'validity_of_technical_Examination.date' => "A műszaki vizsga érvényessége csak dátum formátumú lehet!",
        ];
    }
}
