<?php

namespace App\Models\Facturar;

use App\Models\Administracion\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table="pago";
    protected $fillable=[
        'pedido_id',
        'empleado_id',
        'vuelto'
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'empleado_id');
    }
    public function pedido()
    {
        return $this->belongsTo(Pedido::class,'pedido_id');
    }
    public function pagoTarjeta(){
        return $this->hasMany(DetallePagoTarjeta::class,'pago_id');
    }
    public function pagoEfectivo(){
        return $this->hasOne(PagoEfectivo::class,'pago_id');
    }
}
