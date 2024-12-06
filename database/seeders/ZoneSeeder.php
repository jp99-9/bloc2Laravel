<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = new Zone();
        $zones->name = 'Centre';
        $zones->save();

        $zones = new Zone();
        $zones->name = 'Nord';
        $zones->save();

        $zones = new Zone();
        $zones->name = 'Sud';
        $zones->save();

        $zones = new Zone();
        $zones->name = 'Llevant';
        $zones->save();

        $zones = new Zone();
        $zones->name = 'Ponent';
        $zones->save();
    }
}
