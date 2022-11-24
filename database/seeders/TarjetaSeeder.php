<?php

namespace Database\Seeders;

use App\Models\Facturar\Tarjeta;
use Illuminate\Database\Seeder;

class TarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarjeta=new Tarjeta();
        $tarjeta->tarjeta="BBVA";
        $tarjeta->tipo_id=1;
        $tarjeta->save();

        $tarjeta=new Tarjeta();
        $tarjeta->tarjeta="BancoFalabella";
        $tarjeta->tipo_id=2;
        $tarjeta->save();
    }
}
