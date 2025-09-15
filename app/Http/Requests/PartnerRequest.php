<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => ['required','string','max:120'],
            'website_url' => ['nullable','url','max:255'],
            'logo_url'    => ['nullable','url','max:255'], // external logo হলে
            'logo'   => ['nullable','image'], // local upload হলে
            'sort_order'  => ['nullable','integer','min:0'],
            'is_active'   => ['sometimes','boolean'],
        ];
    }
}
