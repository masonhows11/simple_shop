<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
// use App\Rules\MobileRule;
class AdminRegisterRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            //'mobile' => ['required', 'unique:admins', new MobileRule()],
            'name' => ['required', 'unique:admins', 'min:1', 'max:50'],
            //'first_name' => ['required', 'min:1', 'max:50'],
            //'last_name' => ['required', 'min:1', 'max:50'],
            'email' => ['required', 'unique:admins', 'email'],
            'department' =>['required'],
            'password' => ['required','min:3','max:30'],
            'password_confirmation' => ['required','min:3','max:30','same:password']
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     */
    public function messages(): array
    {
        return [
            'department.required' => 'فیلد بخش الزامی است.',
            'mobile.required' => 'شماره موبایل خود را وارد کنید.',
            'mobile.unique' => 'شماره موبایل وارد شده تکراری است.',

            'name.required' => 'نام کاربری را وارد کنید.',
            'name.min' => 'حداقل ۱ کاراکتر وارد کنید.',
            'name.max' => 'حداکثر ۵۰ کاراکتر.',
            'name.unique' => 'نام کاربری وارد شده تکراری است.',

            'first_name.required' => 'نام خود را وارد کنید.',
            'first_name.min' => 'حداقل ۱ کاراکتر وارد کنید.',
            'first_name.max' => 'حداکثر ۵۰ کاراکتر',

            'last_name.required' => 'نام خانوادگی خود را وارد کنید.',
            'last_name.min' => 'حداقل ۱ کاراکتر وارد کنید.',
            'last_name.max' => 'حداکثر ۵۰ کاراکتر',

            'email.required' => 'ایمیل خود را وارد کنید.',
            'email.email' => 'فرمت ایمیل وارد شده صحبح نمی باشد. ',
            'email.unique' => 'ایمیل وارد شده تکراری است.',
        ];
    }
}
