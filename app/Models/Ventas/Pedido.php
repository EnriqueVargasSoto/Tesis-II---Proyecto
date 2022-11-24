<?php

namespace App\Models\Ventas;

use App\Models\Administracion\Cliente;
use App\Models\Administracion\Empleado;
use App\Models\Facturar\DocumentoVenta;
use App\Models\Facturar\Pago;
use App\Models\Producto;
use App\Models\TipoPedido;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = "pedido";
    protected $fillable = [
        'tipo_id',
        'cliente_id',
        'total',
        'estado_pedido',
        'estado'
    ];
    public $timestamps = true;
    public function documentoVenta()
    {
        return $this->hasOne(DocumentoVenta::class,'pedido_id');
    }
    public function tipo(){
        return $this->belongsTo(TipoPedido::class,'tipo_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function detalle()
    {
        return $this->hasMany(DetallePedido::class, 'pedido_id');
    }
    public function pedidoMesa()
    {
        return $this->hasMany(PedidoMesa::class, 'pedido_id');
    }
    public function pago()
    {
        return $this->hasOne(Pago::class, 'pedido_id');
    }
    public function pedido_ubicacion(){
        return $this->hasOne(DetallePedidoUbicacion::class,'pedido_id');
    }
    public function productos()
    {
        return $this->belongsToMany(Producto::class,'detalle_pedido','pedido_id','producto_id');
    }
    public function total()
    {
        $total = 0;
        foreach ($this->detalle as $key => $value) {
            if ($value->estado_pedido == "ENTREGADO") {
                $total = $total + ($value->cantidad * $value->producto->precio);
            }
        }
        return $total;
    }
}
