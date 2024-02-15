<?php

namespace Thtocha\ContactsPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'surname' => ['required', 'string', 'max:255'],
            'phones' => ['required', 'array', 'unique:phone_numbers,phone_number'],
            'phones.*' => ['required', 'string', 'regex:/^\+\d{1,3}\d{9,15}$/']
        ];
    }
}
