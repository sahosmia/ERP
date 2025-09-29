<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFabricRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'fabric_no' => 'required|string|unique:fabrics,fabric_no|max:255',
            'composition' => 'required|string|max:255',
            'gsm' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'cuttable_width' => 'required|string|max:255',
            'production_type' => 'required|in:Sample Yardage,SMS,Bulk',
            'supplier_id' => 'required|exists:suppliers,id',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
