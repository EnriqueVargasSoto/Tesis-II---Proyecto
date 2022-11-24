<?php

namespace Database\Seeders;

use App\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permiso=new Permission();
        $permiso->name="Facturar";
        $permiso->slug="facturar.index";
        $permiso->description="Acceso a Facturar";
        $permiso->save();
    }
}
