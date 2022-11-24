<?php

namespace Database\Seeders;

use App\Models\TipoMovimientoCaja;
use Illuminate\Database\Seeder;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo=new TipoMovimientoCaja();
        $tipo->tipo_movimiento="APERTURA";
        $tipo->save();

        $tipo=new TipoMovimientoCaja();
        $tipo->tipo_movimiento="CIERRE";
        $tipo->save();
    }
}
