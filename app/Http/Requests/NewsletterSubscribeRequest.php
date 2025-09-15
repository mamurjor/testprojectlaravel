<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsletterSubscribeRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'email' => ['required','email','max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'ইমেইল দিন',
            'email.email'    => 'সঠিক ইমেইল দিন',
        ];
    }
}
