<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CompanyStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'logo_path' => ['required', File::types(['jpg', 'png', 'bmp'])->max(1024)]
        ];
    }

    public function attributes(): array
    {
        return [
            'logo_path' => 'logo'
        ];
    }
}
