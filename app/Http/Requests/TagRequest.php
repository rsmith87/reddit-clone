<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'unique:tags,name'],
        ];
    }
}
