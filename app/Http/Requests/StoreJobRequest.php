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
            'experience_level' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'requirements' => 'nullable|array',
            'requirements.*' => 'string|max:500',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:500',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'application_deadline' => 'nullable|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du poste est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'description.min' => 'La description doit contenir au moins 50 caractères.',
            'company_id.required' => 'La société est obligatoire.',
            'company_id.exists' => 'La société sélectionnée n\'existe pas.',
            'location.required' => 'La localisation est obligatoire.',
            'type.required' => 'Le type de contrat est obligatoire.',
            'type.in' => 'Le type de contrat doit être CDI, CDD, Freelance ou Stage.',
            'salary_max.gte' => 'Le salaire maximum doit être supérieur ou égal au salaire minimum.',
            'application_deadline.after' => 'La date limite de candidature doit être dans le futur.',
        ];
    }
}
