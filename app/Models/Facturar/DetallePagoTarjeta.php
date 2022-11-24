<?php

namespace App\Models\Facturar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePagoTarjeta extends Model
{
    use HasFactory;
    protected $table="detalle_tarjeta";
    protected $fillable=[
        'tarjeta_id','cuenta','cci','cantidad','pago_id',
    ];
    public $timestamps=true;
    public function tarjeta(){
        return $this->belongsTo(Tarjeta::class,'tarjeta_id');
    }
    public function pago(){
        return $this->belongsTo(Pago::class,'pago_id');
    }
}
