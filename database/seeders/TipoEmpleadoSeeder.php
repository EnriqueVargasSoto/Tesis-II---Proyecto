<?php

namespace Database\Seeders;

use App\Models\Administracion\TipoEmpleado;
use Illuminate\Database\Seeder;

class TipoEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoempleado=new TipoEmpleado();
        $tipoempleado->tipo="Cantinero";
        $tipoempleado->save();

        $tipoempleado=new TipoEmpleado();
        $tipoempleado->tipo="Chef";
        $tipoempleado->save();

        $tipoempleado=new TipoEmpleado();
        $tipoempleado->tipo="SubChef";
        $tipoempleado->save();

        $tipoempleado=new TipoEmpleado();
        $tipoempleado->tipo="Mesero";
        $tipoempleado->save();

        $tipoempleado=new TipoEmpleado();
        $tipoempleado->tipo="Cajero";
        $tipoempleado->save();

    }
}
