<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedidoUbicacion extends Model
{
    use HasFactory;
    protected $table="pedido_detalle_ubicacion";
    protected $fillable=[
        'pedido_id',
        'latitud',
        'longitud',
        'direccion'
    ];
    public $timestamps=true;
    public function pedido(){
        return $this->belongsTo(Pedido::class,'pedido_id');
    }
}
