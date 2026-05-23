<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class SignupRequest extends FormRequest
{
    #[Override]
    public function messages() : array
    {
        return [
            'name.required' => 'El Nombre es obligatorio',
            'email.required' => 'El E-mail es obligatorio',
            'email.email' => 'E-mail no valido',
            'email.unique' => 'Este correo ya esta registrado.',
            'password.required' => 'La Contraseña es obligatoria',
            'password.confirmed' => 'La Contraseña no coinciden',
            'password.min' => 'La Contraseña debe de contener almenos :min caracteres',
            'password.letters' => 'La Contraseña debe contener almenos 1 letra',
            'password.mixed' => 'La Contraseña debe contener almenos 1 letra mayuscula y letra minuscula',
            'password.symbols' => 'La Contraseña debe contener almenos 1 caracter especial',
            'password.numbers' => 'La Contraseña debe contener almenos 1 numero',
            'password.uncompromised' => 'La Contraseña ha aparecido en filtraciones de datos. Elige una mas segura.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => [
                'required', 
                'email',
                'unique:users,email'
            ],
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
            // 'password' => ['required', 'confirmed', 'min:8']
        ];
    }
}
