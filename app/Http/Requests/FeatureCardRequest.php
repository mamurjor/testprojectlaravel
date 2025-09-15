<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeatureCardRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'        => ['required','string','max:120'],
            'description'  => ['nullable','string','max:500'],
            'icon_class'   => ['nullable','string','max:100'], // e.g. bi-people-fill
            'accent_color' => ['nullable','string','max:20'],  // e.g. #0ea5a8
            'sort_order'   => ['nullable','integer','min:0'],
            'is_active'    => ['sometimes','boolean'],
        ];
    }
}
