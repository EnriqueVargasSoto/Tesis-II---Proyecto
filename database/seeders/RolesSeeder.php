<?php

namespace Database\Seeders;

use App\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $rol=Role::create([
            'name'=>'Cantinero',
            'slug'=>'Cantinero',
            'description'=>'Acceso a Cantinero',
            'full-access'=>'yes',
            'eliminar'=>'no'
        ]);
        $rol=Role::create([
            'name'=>'Chef',
            'slug'=>'Chef',
            'description'=>'Acceso a Chef',
            'full-access'=>'yes',
            'eliminar'=>'no'
        ]);
        $rol=Role::create([
            'name'=>'SubChef',
            'slug'=>'SubChef',
            'description'=>'Acceso a SubChef',
            'full-access'=>'yes',
            'eliminar'=>'no'
        ]);
        $rol=Role::create([
            'name'=>'Mesero',
            'slug'=>'Mesero',
            'description'=>'Acceso a Mesero',
            'full-access'=>'yes',
            'eliminar'=>'no'
        ]);
        $rol=Role::create([
            'name'=>'Cajero',
            'slug'=>'Cajero',
            'description'=>'Acceso a Cajero',
            'full-access'=>'yes',
            'eliminar'=>'no'
        ]);
    }
}
