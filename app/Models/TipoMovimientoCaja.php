<?php

namespace App\Models;

use App\Models\Mantenimiento\MovimientoCaja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimientoCaja extends Model
{
    use HasFactory;
    protected $table="tipo_movimiento_caja";
    protected $fillable = [
        'tipo_movimiento'
    ];
    public function movimiento()
    {
        return $this->hasMany(MovimientoCaja::class,'tipo_id');
    }
}
