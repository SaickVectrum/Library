<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
	//Esto se coloca para que el factory se identifique mas facilmente con el modelo
	protected $model = User::class;

	public function definition()
	{
		return [
			//Este lo que hace es hacer referencia a una variable que trae a traves de Factory
			'number_id' => $this->faker->randomNumber(8, true),
			'name' => $this->faker->name(),
			//Este es un alias
			'last_name' => fake()->name(),
			'email' => fake()->unique()->safeEmail(),
			'password' => bcrypt(123456789),
			'remember_token' => Str::random(10),
		];
	}

	/**
	 * Indicate that the model's email address should be unverified.
	 *
	 * @return static
	 */
	// public function unverified()
	// {
	//     return $this->state(fn (array $attributes) => [
	//         'email_verified_at' => null,
	//     ]);
	// }
}
