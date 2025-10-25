<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isRecruiter());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $companyId = $this->route('company') ? $this->route('company')->id : $this->route('id');
        
        return [
            'name' => 'required|string|max:255|unique:companies,name,' . $companyId,
            'description' => 'nullable|string|max:1000',
            'website' => 'nullable|url|max:255',
            'size' => 'nullable|string|max:50',
            'industry' => 'nullable|string|max:100',
            'specialisation' => 'nullable|string|max:255',
            'years_experience' => 'nullable|integer|min:0|max:50',
            'location' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de l\'entreprise est requis.',
            'name.unique' => 'Une entreprise avec ce nom existe déjà.',
            'website.url' => 'L\'URL du site web doit être valide.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.mimes' => 'Le logo doit être au format JPEG, PNG ou JPG.',
            'logo.max' => 'Le logo ne peut pas dépasser 2MB.',
        ];
    }
}
