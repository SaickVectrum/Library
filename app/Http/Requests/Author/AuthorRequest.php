<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
			'name' => ['required', 'string'],
			'biography' => ['string'],
		];

		return $rules;
    }
}
