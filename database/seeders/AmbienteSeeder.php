<?php

namespace Database\Seeders;

use App\Models\Mantenimiento\Ambiente;
use Illuminate\Database\Seeder;

class AmbienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ambiente=new Ambiente();
        $ambiente->nombre="Primer Ambiente";
        $ambiente->save();

        $ambiente=new Ambiente();
        $ambiente->nombre="Segundo Ambiente";
        $ambiente->save();

        $ambiente=new Ambiente();
        $ambiente->nombre="Tercer Ambiente";
        $ambiente->save();
    }
}
