<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

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
            'name' => 'Jose Diaz',
            'email' => 'jose123@gmail.com',
            'password' => Hash::make('root')
        ]);

        User::create([
            'name' => 'David Lora',
            'email' => 'lora985@gmail.com',
            'password' => Hash::make('root2')
        ]);
    }
}
