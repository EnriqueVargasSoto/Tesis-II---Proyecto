<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $table="caja";
    protected $fillable=[
        'nombre','estado','estado_caja'
    ];
    public $timestamps=true;
    public function Movimientos()
    {
        return $this->hasMany(MovimientoCaja::class,'caja_id');
    }
}
