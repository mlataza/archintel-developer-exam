<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ArticleUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // TODO: Modify rules for the editor

        return [
            'title' => ['required', 'string', 'max:255'],
            'image_path' => ['nullable', File::types(['jpg', 'png', 'bmp'])],
            'link' => ['required', 'url'],
            'content' => ['required'],
            'company_id' => ['required'],
        ];
    }
}
