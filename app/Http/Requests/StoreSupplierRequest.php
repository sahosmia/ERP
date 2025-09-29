<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For now, we'll allow any authenticated user to create a supplier.
        // You might want to add more specific authorization logic here later.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'country' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'code' => 'required|string|unique:suppliers,code|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'representative_name' => 'nullable|string|max:255',
            'representative_email' => 'nullable|email|max:255',
            'representative_phone' => 'nullable|string|max:255',
        ];
    }
}