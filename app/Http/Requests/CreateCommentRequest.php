<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCommentRequest extends FormRequest
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
            'content' => 'required',
            //'user_id' => 'required|exists:users,id',
           //'article_id' => 'required|exists:articles,id',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' =>false,
            'status_code' =>422,
            'error' => true,
            'message' => 'veuillez insérer votre commentaire',
            'errorsList' => $validator->errors()
        ]));
    }

    public function messages(){
        return [
            'content.required' => 'Vous devez entrer un commentaire',
        ];
    }
}
