<?php

namespace Database\Seeders;

use App\Models\Facturar\TipoTarjeta;
use Illuminate\Database\Seeder;

class TipoTarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo=new TipoTarjeta();
        $tipo->tipo="visa";
        $tipo->save();

        $tipo=new TipoTarjeta();
        $tipo->tipo="mastercard";
        $tipo->save();
    }
}
