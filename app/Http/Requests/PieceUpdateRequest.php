<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PieceUpdateRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'qty' => ['required', 'integer'],
            'hours' => ['required', 'numeric', 'gt:0', 'between:0,99999'],
            'status' => ['required', 'in:Pedido,Proceso,Terminado,Pausado,Cancelado'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'worker_id' => ['required', 'integer', 'exists:workers,id'],
            'piece_category_id' => ['required', 'integer', 'exists:piece_categories,id'],
        ];
    }
}
