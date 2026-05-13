<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProgramFeatureRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'feature_text' => 'required|string|max:255',
            'icon'         => 'nullable|string|max:100',
            'sort_order'   => 'nullable|integer|min:0',
        ];
    }
}
