<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEmployeeRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:256',
            'position_id' => 'required|integer|exists:positions,id',
            'hire_date' => 'required|date|before_or_equal:today',
            'phone' => [
                'required',
                'string',
                'regex:/^\+380\d{9}$/'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255'
            ],
            'salary' => 'required|numeric|min:1|max:500000',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:5120|dimensions:min_width=300,min_height=300',
            'manager_id' => [
                'nullable',
                'integer',
                Rule::exists('employees', 'id')
            ],
        ];
    }
}
