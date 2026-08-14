<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required|in:credit_card,debit_card,wallet,cash',
            'payment_reference' => 'required|string',
            'status' => 'required|in:pending,completed,failed',
        ];
    }
}
