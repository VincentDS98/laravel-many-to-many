<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Helpers
use Illuminate\Support\Facades\Auth;


class StoreTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:64',
            'slug'=> 'nullable|max:64',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Inserisci un Titolo per il Linguaggio',
        ];
    }

}