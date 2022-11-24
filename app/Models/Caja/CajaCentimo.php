<?php

namespace App\Models\Caja;

use App\Models\Facturar\Centimo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaCentimo extends Model
{
    use HasFactory;
    protected $table="caja_centimo";
    protected $fillable=[
        'centimo_id',
        'mcaja_id',
        'cantidad'
    ];
    public $timestamps=true;

    public function centimo()
    {
        return $this->belongsTo(Centimo::class,'centimo_id');
    }
    public function movimiento_caja()
    {
        return $this->belongsTo(MovimientoCaja::class,'mcaja_id');
    }
}
