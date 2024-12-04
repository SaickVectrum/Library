<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
			'biography' => $this->faker->paragraph()
        ];
    }

	public function configure()
	{
		//Despues de crearse el author, se le pasa dicho author creado, y se llama al BookFactory para asignarle 8 libros al autor, y se relaciona el author con el libro, a traves de la funcion "authorId()" creada en el BookFactory
		return $this->afterCreating(function (Author $author){
			Book::Factory(8)->authorId($author)->create();
		});
	}
}
