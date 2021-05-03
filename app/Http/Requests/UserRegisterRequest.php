<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:5|max:40',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama dibutuhkan!',
            'email.email' => 'Format email salah!',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Jumlah minimal password: 5',
            'password.max' => 'Maksimal huruf password adalah 40',
        ];
    }
}
