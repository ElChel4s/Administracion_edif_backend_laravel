<?php

namespace App\Modules\Auth\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nombre' => 'required|string|max:100',
            'apellido' => 'nullable|string|max:100',
            'email' => 'required|email|max:150|unique:usuarios,email',
            'password' => 'required|string|min:6',
            'telefono' => 'nullable|string|max:20',
            'tipo_usuario' => 'required|in:Administrador,Residente,Visitante',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres.',
            'apellido.max' => 'El apellido no puede tener más de 100 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe tener un formato válido.',
            'email.max' => 'El email no puede tener más de 150 caracteres.',
            'email.unique' => 'Este email ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'tipo_usuario.required' => 'El tipo de usuario es obligatorio.',
            'tipo_usuario.in' => 'El tipo de usuario debe ser: Administrador, Residente o Visitante.',
        ];
    }
}