<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
		'number_id' => '10932121',
        'name' => 'Victor',
		'last_name' => 'Zea',
        'email' => 'victor.zea@example.com',
        'password' => bcrypt(123456789),
		]);
    }
}
