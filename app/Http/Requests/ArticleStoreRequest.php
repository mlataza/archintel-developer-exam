<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ArticleStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'image_path' => ['required', File::types(['jpg', 'png', 'bmp'])->max(1024)],
            'link' => ['required', 'url'],
            'content' => ['required'],
            'company_id' => ['required'],
        ];
    }
}
