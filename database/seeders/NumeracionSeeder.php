<?php

namespace Database\Seeders;

use App\Models\Mantenimiento\Numeracion;
use Illuminate\Database\Seeder;

class NumeracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Numeracion::create([
            'tipo_documento_id'=>1,
            "serie"=>"B001",
            "correlativo_iniciar"=>1,
            "seleccionado"=>"SI",
            "estado"=>'ACTIVO'
        ]);

        Numeracion::create([
            'tipo_documento_id'=>2,
            "serie"=>"F001",
            "correlativo_iniciar"=>1,
            "seleccionado"=>"SI",
            "estado"=>'ACTIVO'
        ]);
    }
}
