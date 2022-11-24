<?php

namespace App\Models\Facturar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    use HasFactory;
    protected $table="tarjeta";
    protected $fillable=[
        'tarjeta','tipo'
    ];
    public $timestamps=true;
    public function pago()
    {
        return $this->hasMany(DetallePagoTarjeta::class,'tarjeta_id');
    }
}
