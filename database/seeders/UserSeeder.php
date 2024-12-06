<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'admin';
        $user->lastName = 'admin';  
        $user->email = 'admin@baleart.com';
        $user->phone = '666666666';
        $user->password = bcrypt('12345678');
        $user->role_id = Role::where('name', 'administrador')->first()->id;
        $user->save();


        $jsonData = file_get_contents('c:\\temp\\baleart\\usuaris.json');
        $users = json_decode($jsonData, true);

        foreach ($users['usuaris']['usuari'] as $user) {
            User::create([
                'name' => $user['nom'],
                'lastName' => $user['llinatges'],
                'email' => $user['email'],
                'phone' => $user['telefon'],
                'password' => bcrypt($user['password']),
                'role_id' => Role::where('name', 'gestor')->first()->id,
            ]);
        }


        
    }
}
