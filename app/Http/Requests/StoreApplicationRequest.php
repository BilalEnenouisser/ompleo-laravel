<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'nullable|string|max:2000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ];
    }

    public function messages(): array
    {
        return [
            'job_id.required' => 'L\'offre d\'emploi est obligatoire.',
            'job_id.exists' => 'L\'offre d\'emploi sélectionnée n\'existe pas.',
            'cover_letter.max' => 'La lettre de motivation ne peut pas dépasser 2000 caractères.',
            'resume.required' => 'Le CV est obligatoire.',
            'resume.file' => 'Le CV doit être un fichier.',
            'resume.mimes' => 'Le CV doit être au format PDF, DOC ou DOCX.',
            'resume.max' => 'Le CV ne peut pas dépasser 5MB.',
        ];
    }
}
