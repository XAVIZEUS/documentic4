<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Region;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::table('companies')->insert([
            'nit' => '321654',
            'nombre' => 'UNISABROSA',
        ]);

        DB::table('regions')->insert([
            [
                'idRegion' => 'LPZ',
                'departamento' => 'La Paz',
                'ubicacion' => 'Av. Camacho',
                'nit' => '321654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRegion' => 'CBBA',
                'departamento' => 'Cochabamba',
                'ubicacion' => 'Av. Bolivia',
                'nit' => '321654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRegion' => 'SCZ',
                'departamento' => 'Santa Cruz',
                'ubicacion' => 'Ubicación de Santa Cruz',
                'nit' => '321654',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('offices')->insert([
            [
                'idOficina' => 'COM',
                'nombre' => 'Comercial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idOficina' => 'PRO',
                'nombre' => 'Produccion y Cobranzas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idOficina' => 'ADM',
                'nombre' => 'Adminstracion y Finanzas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idOficina' => 'GG',
                'nombre' => 'Gerencia General',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('roles')->insert([
            [
                'idRol' => '1',
                'nombre' => 'Administracion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRol' => '2',
                'nombre' => 'Usuario',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idRol' => '3',
                'nombre' => 'Ventanilla',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('works')->insert([
            [
                'idCargo' => '1',
                'nombre' => 'Ing. en Sistemas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idCargo' => '2',
                'nombre' => 'ing. Comercial',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idCargo' => '3',
                'nombre' => 'Auditor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idCargo' => '4',
                'nombre' => 'Abogado',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        DB::table('actions')->insert([
            [
                'nombre' => 'Para su consideracion',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Archivar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Despachar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Producción',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Preparar informe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Para su respuesta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $faker = Faker::create();

        DB::table('users')->insert([
            'idRegion' => $faker->randomElement(['LPZ','CBBA','SCZ']),
            'usuario' => 'admin',
            'password' => bcrypt(123),
            'apellidos' => 'admin',
            'nombres' => 'admin',
            'ci' => $faker->numberBetween(1000000, 9999999),
            'correo' => $faker->unique()->safeEmail,
            'idOficina' => 'ADM',
            'mosca' => 'admin',
            'idCargo' => 1,
            'estado' => 1,
            'celular' => $faker->phoneNumber,
            'url_foto' => 'fotos_perfiles/undraw_profile_2.svg'
        ]);
        
        for ($i = 0; $i < 50; $i++) {
            $nombres = $faker->firstName;
            $apellidos = $faker->lastName;
            $mosca = strtoupper(substr($nombres, 0, 1) . substr($apellidos, 0, 1));
            $idRegion = $faker->randomElement(['LPZ','CBBA','SCZ']);
            $idOficina = $faker->randomElement(['GG', 'ADM', 'PRO', 'COM']);
            DB::table('users')->insert([
                'idRegion' => $idRegion,
                'usuario' => 'UB-'.$idRegion.'-'.$idOficina.'-'.$nombres.'.'.$apellidos,
                'password' => bcrypt(123),
                'apellidos' => $apellidos,
                'nombres' => $nombres,
                'ci' => $faker->numberBetween(1000000, 9999999),
                'correo' => $faker->unique()->safeEmail,
                'idOficina' => $idOficina,
                'mosca' => $mosca,
                'idCargo' => $faker->randomElement([1, 2, 3, 4]),
                'estado' => $faker->randomElement([0, 1, 2]),
                'celular' => $faker->phoneNumber,
            ]);
        }

        //ADMIN
        $admin = User::find(1);
        $admin->roles()->attach(1);

        //USERS
        $users = User::find(2);
        $users->usuario = 'usuario';
        $users->idOficina = 'ADM';
        $users->estado = 1;
        $users->save();
        $users->roles()->attach(2);

        //VENTANILLA
        $ventanilla = User::find(3);
        $ventanilla->usuario = 'ventanilla';
        $ventanilla->estado = 1;
        $ventanilla->save();
        $ventanilla->roles()->attach(3);

        $users = User::where('idUsuario', '>', 3)->get();
        foreach ($users as $user) {
            $user->roles()->attach($faker->randomElement([2, 3]));
        }


        //CLIENTES

        for ($i = 0; $i < 20; $i++) {
            DB::table('customers')->insert([
                'nombre' => $faker->name,
                'cargo' => $faker->word,
                'institucion' => $faker->company,
                'telefono' => $faker->phoneNumber,
                'ciudad' => $faker->city,
                'direccion' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        DB::table('types')->insert([
            ['nombre' => 'Carta',],
            ['nombre' => 'Informe',],            
            ['nombre' => 'Memorandum',],
            ['nombre' => 'Otro',],
        ]);
    }
}
