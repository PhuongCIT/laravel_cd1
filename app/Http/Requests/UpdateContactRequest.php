<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
        ];
    }
    public function message(): array
    {
        return [
            'name.required'=>'Tên liên hệ không để trống!',
            'phone.required'=>'Số điện thoại không để trống!',
            'email.required'=>'Email không để trống!',
        ];
    }
}
