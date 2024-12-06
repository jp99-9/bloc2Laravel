<?php

namespace Database\Seeders;

use App\Models\Island;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $islands = new Island();
        $islands->name = 'Mallorca';
        $islands->save();

        $islands = new Island();
        $islands->name = 'Menorca';
        $islands->save();

        $islands = new Island();    
        $islands->name = 'Eivissa';
        $islands->save();
        
        $islands = new Island();
        $islands->name = 'Formentera';
        $islands->save();

        $islands = new Island();
        $islands->name = 'Cabrera';
        $islands->save();

        
    }
}
