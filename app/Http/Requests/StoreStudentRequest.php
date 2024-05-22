<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'dni' => 'required|integer|unique:students,dni',
            'name' => 'required|string|max:255', 
            'lastname' => 'required|string|max:255', 
            'Birthdate' => 'required|date|before_or_equal:' .now()->subYears(18)->format('d-m-Y'), 
            'cluster' => 'required|string|max:255',
        ];
    }
}
