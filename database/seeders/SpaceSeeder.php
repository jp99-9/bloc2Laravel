<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\Municipality;
use App\Models\ModalitySpace;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
        $spaces = json_decode($jsonData, true);

        foreach ($spaces as $space) {
            $accesibilidad = "";

            if ($space['accessibilitat'][0] == "S") {
                $accesibilidad = "Y";
            } elseif ($space['accessibilitat'][0] == "N") {
                $accesibilidad = "N";
            } elseif ($space['accessibilitat'][0] == "P") {
                $accesibilidad = "P";
            }



            $spaceAddress = $space['adreca'];
            Address::create([
                'name' => $spaceAddress,
                'municipality_id' => Municipality::where('name', $space['municipi'])->first()->id,
                'zone_id' => Zone::where('name', $space['zona'])->first()->id,
            ]);
            $newSpace = Space::create([
                'name' => $space['nom'],
                'regNumber' => $space['registre'],
                'observation_ca' => $space['descripcions/cat'],
                'observation_es' => $space['descripcions/esp'],
                'observation_en' => $space['descripcions/eng'],
                'email' => $space['email'],
                'phone' => $space['telefon'],
                'website' => $space['web'],
                'totalScore' => 0,
                'countScore' => 0,
                'accesType' => $accesibilidad,
                'space_type_id' =>  SpaceType::where('name', $space['tipus'])->first()->id,
                'user_id' => User::where('email', $space['gestor'])->first()->id ?? '1',
                'address_id' => Address::where('name', $spaceAddress)->first()->id,



            ]);

            $modalitiesArray = array_map('trim', explode(",", $space['modalitats']));
            $modalities = Modality::whereIn('name', $modalitiesArray)->get();
            $newSpace->modalities()->attach($modalities);

            $servicesArray = array_map('trim', explode(",", $space['serveis']));
            $services = Service::whereIn('name', $servicesArray)->get();
            $newSpace->services()->attach($services);
        }
        


        
    }
}
