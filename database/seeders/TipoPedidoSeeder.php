<?php

namespace Database\Seeders;

use App\Models\TipoPedido;
use Illuminate\Database\Seeder;

class TipoPedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipoPedido=new TipoPedido();
        $tipoPedido->tipo_pedido="Presencial";
        $tipoPedido->save();
        $tipoPedido=new TipoPedido();
        $tipoPedido->tipo_pedido="Delivery";
        $tipoPedido->save();
        // $tipoPedido=new TipoPedido();
        // $tipoPedido->tipo_pedido="LLamada";
        // $tipoPedido->save();
    }
}
