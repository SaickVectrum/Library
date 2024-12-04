<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create([
			'number_id' => '10343243290',
			'name' => 'Victor',
			'last_name' => 'Zea',
			'email' => 'victor.zea@email.com',
			'password' => bcrypt(123456789),
			'remember_token' => Str::random(10),
		]);
	}
}
