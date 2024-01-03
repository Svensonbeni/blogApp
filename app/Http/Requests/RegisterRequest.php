<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
    public function rules()
    {
        return [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' =>false,
            'status_code' =>422,
            'error' => true,
            'message' => 'Erreur de validation',
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages(){
        return [
            'nom.required' => 'Le nom doit être renseigné',
            'prenom.required' => 'Le prenom doit être renseigné',
            'email.required' => 'L\' email doit être renseigné',
            'email.unique' => 'L\'email existe déja',
            'password.required' => 'Le mot de passe  est requis',
        ];
    }
}
