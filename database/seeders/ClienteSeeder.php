<?php

namespace Database\Seeders;

use App\Models\Administracion\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cliente=new Cliente();
        $cliente->nombre="VARIOS CLIENTE";
        $cliente->documento="00000000";
        $cliente->tipo_documento="DNI";
        $cliente->telefono="0";
        $cliente->direccion="-";
        $cliente->email="-";
        $cliente->save();
    }
}
