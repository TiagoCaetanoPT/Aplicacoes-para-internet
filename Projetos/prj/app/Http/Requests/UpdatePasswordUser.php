<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdatePasswordUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->id == Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required',
            'old_password' => ['required',
                                function($attribute, $value, $fail) {
                                    if(!Hash::check($value, Auth::user()->password)) {
                                        $fail('Password Antiga inválida.');
                                    }
                                },
                            ],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Preencha o campo Password Nova.',
            'password.min' => 'O campo Password Nova tem que ter mais que 8 caracteres.',
            'password.same' => 'Os campos Password Nova e Confirmar Password têm que ser iguais.',
            'password_confirmation.required' => 'Preencha o campo Confirmar Password.',
            'old_password.required' => 'Preencha o campo Password Antiga.',
        ];
    }
}
