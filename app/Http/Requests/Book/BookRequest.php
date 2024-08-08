<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
		$rules = [
			'category_id' => ['required', 'numeric'],
			'author_id' => ['required', 'numeric'],
			'title' => ['required', 'string'],
			'stock' => ['required', 'numeric'],
			'description' => ['required', 'string']
		];

		return $rules;
    }
}
