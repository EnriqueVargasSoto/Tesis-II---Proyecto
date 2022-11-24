<?php

namespace App\Models\Ventas;

use App\Models\Administracion\Empleado;
use App\Models\Mesa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoMesa extends Model
{
    use HasFactory;
    protected $table="pedido_mesa";
    protected $fillable = [
        'empleado_id',
        'pedido_id',
        'mesa_id',
    ];
    public $timestamps=true;
    public function pedido(){
        return $this->belongsTo(Pedido::class,'pedido_id');
    }
    public function mesa(){
        return $this->belongsTo(Mesa::class,'mesa_id');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'empleado_id');
    }
}
