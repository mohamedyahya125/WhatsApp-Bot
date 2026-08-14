<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'business_id' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'max_capacity' => 'required|integer',
            'duration' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ];
    }
}
