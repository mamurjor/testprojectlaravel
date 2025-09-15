<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // প্রয়োজনে আপনার auth/policy বসাতে পারেন
    }

    public function rules(): array
    {
        return [
            'title'       => ['required','string','max:255'],
            'subtitle'    => ['nullable','string','max:255'],
            'badge_text'  => ['nullable','string','max:100'],
            'badge_icon'  => ['nullable','string','max:100'],
            'sort_order'  => ['nullable','integer','min:0'],
            'btn1_text'   => ['nullable','string','max:50'],
            'btn1_url'    => ['nullable','url','max:255'],
            'btn2_text'   => ['nullable','string','max:50'],
            'btn2_url'    => ['nullable','url','max:255'],
            'image'       => ['nullable','image'], // 2MB
            'is_active'   => ['sometimes','boolean'],
        ];
    }
}
