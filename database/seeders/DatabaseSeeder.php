<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Image;

use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ZoneSeeder;
use Database\Seeders\IslandSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\ModalitySeeder;
use Database\Seeders\SpaceTypeSeeder;
use PhpParser\Node\Expr\AssignOp\Mod;
use Database\Seeders\MunicipalitySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            IslandSeeder::class,
            RoleSeeder::class,
            ServiceSeeder::class,
            ModalitySeeder::class,
            ZoneSeeder::class,
            UserSeeder::class,
            SpaceTypeSeeder::class,
            MunicipalitySeeder::class,
            SpaceSeeder::class,
            CommentSeeder::class,

        ]);
        User::factory(50)->create();
        Image::factory(10)->create();
    }
}
