<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name'        => 'required',
            'address'     => 'required',
            'phone'       => 'required',
            'cart_items'  => 'required|array',
            'cart_items.*.pizzaId'  => 'required|exists:pizzas,id',
            'cart_items.*.quantity' => 'required|integer|min:1',
            'currency'    => 'required|in:euro,usd'
        ];
    }
}
