<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class categorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::create([
            'created_by' => 1,
            'name' => 'Todo',
            
        ]);

        Categorie::create([
            'name' => 'InProgress',
            'created_by' => 1,
        ]);

        Categorie::create([
            'name' => 'Testing',
            'created_by' => 1,
        ]);
        Categorie::create([
            'name' => 'Done',
            'created_by' => 1,
        ]);
        Categorie::create([
            'name' => 'Pending',
            'created_by' => 1,
        ]);
        
    }
}
