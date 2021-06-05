<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotorwayVignetteCreateRequest extends FormRequest
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
            'type' => 'required',
            'category' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'date_of_purchase' => 'required|date',
            'price' => 'required|numeric|integer',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => "A típus kitöltése kötelező!",

            'category.required' => 'A kategória kitöltése kötelező!',

            'location.required' => 'A érvényesség helyének kitöltése kötelező!',

            'start_date.required' => 'Az érvényesség kezdete megadása kötelező!',
            'start_date.date' => 'Az érvényesség kezdete dátum formátumú kell lenni!',

            'end_date.required' => 'Az érvényesség vége megadása kötelező!',
            'end_date.date' => 'Az érvényesség vége dátum formátumú kell lenni!',

            'date_of_purchase.required' => 'A vásárlás időpontjának megadása kötelező!',
            'date_of_purchase.date' => 'A vásárlás időpontjának dátum formátumú kell lenni!',

            'price.reqiured' => 'A matrica árának megadása kötelező!',
            'price.numeric' => 'A matrica árának szám formátumú kell lenni!',
            'price.integer' => 'A matrica árának szám formátumú kell lenni!',

            'image.image' => 'A csatolt fájlnak kép típusú kell lennie!'
        ];
    }
}
