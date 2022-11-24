<?php

namespace App\Models\Caja;

use App\Models\Mantenimiento\MovimientoCaja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescuadreCaja extends Model
{
    use HasFactory;
    protected $table="descuadre_caja";
    protected $fillable=[
        'mcaja_id',
        'descuadre',
        'descripcion'
    ];
    public $timestamps=true;
    public function movimientoCaja(){
        return $this->belongsTo(MovimientoCaja::class,'mcaja_id');
    }
}
