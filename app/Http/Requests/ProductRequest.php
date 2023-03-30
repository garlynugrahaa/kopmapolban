<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_category_id' => 'required',
            'product_code' => 'required',
            'product_name' => 'required|unique:products|max:150',
            'product_stock' => 'required',
            'product_price' => 'required',
            'product_desc' => 'required',
            'product_exp' => 'date',
        ];
    }
}
