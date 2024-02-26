<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryItemStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'qty' => ['required', 'integer'],
            'price' => ['required', 'numeric', 'between:-99999999,99999999'],
            'inventory_id' => ['required', 'integer', 'exists:inventories,id'],
        ];
    }
}
