<?php

namespace App\Models\Ventas;

use App\Models\Plato;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;
    protected $table="detalle_pedido";
    protected $fillable=[
        'pedido_id',
        'producto_id',
        'cantidad',
        'descripcion',
        'estado_pedido',
    ];
    public $timestamps=true;
    public function pedido(){
        return $this->belongsTo(Pedido::class,'pedido_id');
    }
    public function producto(){
        return $this->belongsTo(Producto::class,'producto_id');
    }

}
