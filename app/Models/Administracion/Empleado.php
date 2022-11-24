<?php

namespace App\Models\Administracion;

use App\Models\Facturar\Pago;
use App\Models\Ventass\PedidoMesa;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table="empleado";
    protected $fillable=[
        'persona_id',
        'tipoempleado_id'
    ];
    public $timestamps=true;
    public function persona()
    {
        return $this->belongsTo(Persona::class,'persona_id');
    }
    public function tipo()
    {
        return $this->belongsTo(TipoEmpleado::class,'tipoempleado_id');
    }
    public function pedidos()
    {
        return $this->hasMany(PedidoMesa::class,'empleado_id');
    }
    public function pago()
    {
        return $this->hasMany(Pago::class,'empleado_id');
    }
}
