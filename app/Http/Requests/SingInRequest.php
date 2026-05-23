<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class SingInRequest extends FormRequest
{

    public function attributes() : array
    {
        return [
            'password' => 'Contraseña'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'email.exists' => 'No encontramos una cuenta con ese correo electronico.'
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
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ];
    }
}
