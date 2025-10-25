<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecruiterProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isRecruiter();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'position' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'company_id' => 'nullable|exists:companies,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'position.max' => 'Le poste ne peut pas dépasser 255 caractères.',
            'phone.max' => 'Le téléphone ne peut pas dépasser 20 caractères.',
            'company_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'avatar.image' => 'L\'avatar doit être une image.',
            'avatar.mimes' => 'L\'avatar doit être au format JPEG, PNG ou JPG.',
            'avatar.max' => 'L\'avatar ne peut pas dépasser 2MB.',
        ];
    }
}