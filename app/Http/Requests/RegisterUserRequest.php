<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:125','unique:users'],
            'email' => ['required','email','min:3','max:125','unique:users'],
            'password' => ['required','email','min:3','max:125'],
            'mobile' => ['nullable', 'digits:11', 'numeric']
        ];
    }
}
