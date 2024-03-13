<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use Illuminate\Support\Facades\Auth;


class StoreProjectRequest extends FormRequest
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


            'title' => 'required|max:255',
            'slug'=> 'nullable|max:255',
            'content' => 'required|max:1024',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|array|exists:technologies,id',
            'cover_img' => 'nullable|image'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Inserisci un Titolo per il tuo Progetto',
            'content.required'=> 'Inserisci una descrizione per il tuo Progetto',
        ];
    }
}