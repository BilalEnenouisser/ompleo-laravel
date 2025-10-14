<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isRecruiter() || auth()->user()->isAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
            'company_id' => 'required|exists:companies,id',
            'location' => 'required|string|max:255',
            'type' => 'required|in:CDI,CDD,Freelance,Stage',
            'work_type' => 'required|in:onsite,remote,hybrid',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'experience_level' => 'nullable|string|max:100',
            'requirements' => 'nullable|array',
            'benefits' => 'nullable|array',
            'tags' => 'nullable|array',
            'application_deadline' => 'nullable|date|after:today',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Le titre de l\'offre est requis.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est requise.',
            'description.min' => 'La description doit contenir au moins 50 caractères.',
            'company_id.required' => 'L\'entreprise est requise.',
            'company_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'location.required' => 'La localisation est requise.',
            'type.required' => 'Le type de contrat est requis.',
            'type.in' => 'Le type de contrat doit être CDI, CDD, Freelance ou Stage.',
            'work_type.required' => 'Le type de travail est requis.',
            'work_type.in' => 'Le type de travail doit être sur site, à distance ou hybride.',
            'salary_min.numeric' => 'Le salaire minimum doit être un nombre.',
            'salary_min.min' => 'Le salaire minimum ne peut pas être négatif.',
            'salary_max.numeric' => 'Le salaire maximum doit être un nombre.',
            'salary_max.min' => 'Le salaire maximum ne peut pas être négatif.',
            'salary_max.gte' => 'Le salaire maximum doit être supérieur ou égal au salaire minimum.',
            'application_deadline.date' => 'La date limite doit être une date valide.',
            'application_deadline.after' => 'La date limite doit être dans le futur.',
        ];
    }
}