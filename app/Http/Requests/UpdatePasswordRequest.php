<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function messages(): array
    {
        return [
            'current_password.required' => 'Debes ingresar tu contraseña actual.',
            'current_password.current_password' => 'La contraseña actual es incorrecta.',
            'password.required' => 'La Nueva Contraseña no puede ir vacia',
            'password.min' => 'La Contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las Nuevas Contraseñas no coinciden.',
        ];
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                    // ->letters()
                    // ->mixedCase()
                    // ->symbols()
                    // ->numbers()
                    // ->uncompromised()
            ]
        ];
    }
}