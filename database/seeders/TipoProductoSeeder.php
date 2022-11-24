<?php

namespace Database\Seeders;

use App\Models\TipoProducto;
use Illuminate\Database\Seeder;

class TipoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoproducto=new TipoProducto();
        $tipoproducto->tipo="Platos";
        $tipoproducto->save();

        $tipoproducto=new TipoProducto();
        $tipoproducto->tipo="Bebidas";
        $tipoproducto->save();
    }
}
