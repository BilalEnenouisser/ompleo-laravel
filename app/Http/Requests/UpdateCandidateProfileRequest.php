<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCandidateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isCandidate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'nullable|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
            'languages' => 'nullable|string',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'avatar' => 'nullable|file|max:2048',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'firstName.required' => 'Le prénom est requis.',
            'lastName.required' => 'Le nom est requis.',
            'bio.max' => 'La biographie ne doit pas dépasser 1000 caractères.',
            'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères.',
            'linkedin_url.url' => 'L\'URL LinkedIn doit être valide.',
            'portfolio_url.url' => 'L\'URL du portfolio doit être valide.',
            'avatar.file' => 'Le fichier avatar doit être un fichier valide.',
            'avatar.max' => 'Le fichier avatar ne doit pas dépasser 2MB.',
        ];
    }
}
