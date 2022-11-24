<?php

namespace Database\Seeders;

use App\Models\Facturar\Moneda;
use Illuminate\Database\Seeder;

class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $moneda=new Moneda();
        $moneda->moneda="1.00";
        $moneda->abreviatura="1 sol";
        $moneda->save();

        $moneda=new Moneda();
        $moneda->moneda="2.00";
        $moneda->abreviatura="2 soles";
        $moneda->save();

        $moneda=new Moneda();
        $moneda->moneda="5.00";
        $moneda->abreviatura="5 soles";
        $moneda->save();
    }
}
