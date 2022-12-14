<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Adminsitrator',
            'username' => 'admin@gmail.com',
            'password' => Hash::make('admin2021'),
            'remember_token' => '909909',
            
        ]);
    }
}
