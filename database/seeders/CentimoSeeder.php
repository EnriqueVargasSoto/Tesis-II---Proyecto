<?php

namespace Database\Seeders;

use App\Models\Facturar\Centimo;
use Illuminate\Database\Seeder;

class CentimoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centimo=new Centimo();
        $centimo->centimo="0.10";
        $centimo->abreviatura="10 centimos";
        $centimo->save();

        $centimo=new Centimo();
        $centimo->centimo="0.20";
        $centimo->abreviatura="20 centimos";
        $centimo->save();

        $centimo=new Centimo();
        $centimo->centimo="0.50";
        $centimo->abreviatura="50 centimos";
        $centimo->save();

    }
}
