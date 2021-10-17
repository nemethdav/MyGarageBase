<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtherCostsRequest extends FormRequest
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
            'title' => 'required|min:3',
            'price' =>'required|numeric|integer',
            'date' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A cím megadása kötelező',
            'title.min' => 'A címnek minimum 3 karakterből kell állnia!',

            'price.required' => 'Az ár megadása kötelező!',
            'price.numeric' => 'Az ár csak szám lehet!',
            'price.integer' => 'Az ár csak szám lehet!',

            'date.required' => 'A kiadás dátumának megadása kötelező!',
            'date.date' => 'A kiadás dátumának dátum formátumúnak kell lennie!'
        ];
    }
}
