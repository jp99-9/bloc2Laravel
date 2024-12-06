<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents('c:\\temp\\baleart\\serveis.json');
        $services = json_decode($jsonData, true);

        foreach ($services['serveis']['servei'] as $service) {
            Service::create([
                'name' => $service['cat'],
                'description_ca' => $service['cat'],
                'description_es' => $service['esp'],
                'description_en' => $service['eng']

            ]);
        }
    }
}
