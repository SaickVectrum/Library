<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
	protected $model = Book::class;

	//Esta función lo que hace es asignar el id del autor creado a un libro, por lo que esta función es llamada en el "AuthorFactory"
	public function authorId($author)
	{
		//A traves de la función state se le asigna el id, de acuerdo al parametro recibido que es el author recien creado
		return $this->state([
			'author_id' => $author->id
		]);
	}

	public function definition()
	{
		return [
			//Se pone 1, 2, 3 que son los "ids" pertenecientes a las categorias
			'category_id' => $this->faker->randomElement([1, 2, 3]),
			'title' => $this->faker->sentence(),
			'stock' => $this->faker->randomDigit(),
			'description' => $this->faker->paragraph()
		];
	}
}
