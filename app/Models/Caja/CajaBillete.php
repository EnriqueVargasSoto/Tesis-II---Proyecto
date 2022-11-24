<?php

namespace App\Models\Caja;

use App\Models\Facturar\Billete;
use App\Models\Mantenimiento\MovimientoCaja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaBillete extends Model
{
    use HasFactory;
    protected $table="caja_billete";
    protected $fillable=[
        'billete_id',
        'mcaja_id',
        'cantidad'
    ];
    public $timestamps=true;

    public function billete()
    {
        return $this->belongsTo(Billete::class,'billete_id');
    }
    public function movimiento_caja()
    {
        return $this->belongsTo(MovimientoCaja::class,'mcaja_id');
    }
}
