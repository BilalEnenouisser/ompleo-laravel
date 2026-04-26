<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    return auth()->check() && 
           (auth()->user()->isRecruiter() || auth()->user()->isAdmin());
}

public function rules(): array
{
    return [
        'title'       => 'sometimes|string|max:255',
        'description' => 'sometimes|string|min:10',
        'location'    => 'sometimes|string|max:255',
        'type'        => 'sometimes|string',
        'status'      => 'sometimes|in:draft,published,pending,expired,closed,suspended',
    ];
}
}
