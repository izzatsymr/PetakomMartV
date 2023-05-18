<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'subtotal_sales' => ['required', 'numeric'],
            'service_tax' => ['required', 'numeric'],
            'total_sales' => ['required', 'numeric'],
            'status' => ['required', 'in:completed,refunded'],
            'refunded_reason' => ['nullable', 'max:255', 'string'],
        ];
    }
}
