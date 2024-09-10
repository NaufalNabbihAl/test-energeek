<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\User::create([
            'id' => 1,
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'created_by' => 1,                     
        ]);
    }
}
