<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'yallungrai277@gmail.com',
            'password' => Hash::make('Password123!'),
            'email' => 'yallungrai277@gmail.com'
        ]);
    }
}