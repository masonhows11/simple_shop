<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
            //'mobile' => ['required', 'unique:admins', new MobileRule()],
            'title' => ['required', 'min:5', 'max:50'],
            'message' => ['required','min:5', 'max:500'],
            'priority' => ['required'],
            'department' => ['required'],
            'file' =>['nullable','']
        ];
    }

    public function messages(): array
    {
        return [
            'department.required' => 'فیلد بخش الزامی است.',
            'department.priority' => 'فیلد بخش الزامی است.',
        ];
    }
}
