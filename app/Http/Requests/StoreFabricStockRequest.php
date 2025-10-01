<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFabricStockRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'transaction_type' => 'required|in:in,out',
            'qty' => 'required|numeric|min:0.01',
            'barcode' => 'nullable|string|max:255|unique:fabric_stocks,barcode',
            'remarks' => 'nullable|string',
        ];
    }
}