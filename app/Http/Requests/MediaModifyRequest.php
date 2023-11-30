<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaModifyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'preserveAspectRatio' => ['boolean'],
            'opacity'             => ['integer'],
            'overwriteOriginal'   => ['boolean'],
            'name'                => ['string'],
            'width'               => ['integer'],
            'height'              => ['integer'],
            'extension'           => ['string'],
        ];
    }
}
