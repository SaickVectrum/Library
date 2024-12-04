<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		//Se llaman primero los seeder que los factory
		$this->call([UserSeeder::class, CategorySeeder::class]);


		//Este llama al modelo User para poder generar la insercion de los datos,
		//el modelo debe tener la propiedad HasFactory para que busque el factory
		//y ejecute el codigo de este
		//Aca se coloca el numero de veces que se ejecute el factory, por lo que se crearian 10 usuarios
		User::factory(10)->create();
		Author::factory(20)->create();
		// \App\Models\User::factory()->create([
		//     'name' => 'Test User',
		//     'email' => 'test@example.com',
		// ]);
	}
}
