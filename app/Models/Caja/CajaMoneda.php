<?php

namespace App\Models\Caja;

use App\Models\Facturar\Moneda;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaMoneda extends Model
{
    use HasFactory;
    protected $table="caja_moneda";
    protected $fillable=[
        'moneda_id',
        'mcaja_id',
        'cantidad'
    ];
    public $timestamps=true;

    public function moneda()
    {
        return $this->belongsTo(Moneda::class,'moneda_id');
    }
    public function movimiento_caja()
    {
        return $this->belongsTo(MovimientoCaja::class,'mcaja_id');
    }
}
