<?php

namespace Database\Seeders;

use App\Models\Facturar\Billete;
use Illuminate\Database\Seeder;

class BilleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billete=new Billete();
        $billete->billete="10";
        $billete->abreviatura="10 soles";
        $billete->save();

        $billete=new Billete();
        $billete->billete="20";
        $billete->abreviatura="20 soles";
        $billete->save();

        $billete=new Billete();
        $billete->billete="50";
        $billete->abreviatura="50 soles";
        $billete->save();

        $billete=new Billete();
        $billete->billete="100";
        $billete->abreviatura="100 soles";
        $billete->save();

        $billete=new Billete();
        $billete->billete="200";
        $billete->abreviatura="200 soles";
        $billete->save();

    }
}
