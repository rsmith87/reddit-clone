<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bio'     => ['sometimes', 'string', 'max:255'],
            'city'    => ['sometimes', 'string', 'max:64'],
            'state'   => ['sometimes', 'string', 'max:64'],
            'twitter' => ['sometimes', 'string', 'max:64'],
            'website' => ['sometimes', 'string', 'url', 'max:255'],
        ];
    }
}
