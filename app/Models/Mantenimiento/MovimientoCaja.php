<?php

namespace App\Models\Mantenimiento;

use App\Models\Caja\DescuadreCaja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoCaja extends Model
{
    use HasFactory;
    protected $table="movimiento_caja";
    protected $fillable = [
        'empleado_id',
        'caja_id',
        'tipo_id',
        'monto'
    ];
    public $timestamps=true;
    public function caja(){
        return $this->belongsTo(Caja::class,'caja_id');
    }
    public function tipo_movimiento(){
        return $this->belongsTo(Tipo::class,'tipo_id');
    }
    public function descuadre()
    {
        return $this->hasOne(DescuadreCaja::class,'mcaja_id');
    }
}
