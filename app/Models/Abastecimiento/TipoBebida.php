<?php

namespace App\Models\Abastecimiento;

use App\Models\Bebida;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoBebida extends Model
{
    use HasFactory;
    protected $table="tipo_bebida";
    protected $fillable=[
        'tipo','url_imagen','nombre_imagen','estado'
    ];
    public function bebidas()
    {
        return $this->hasMany(Bebida::class,'tipobebida_id');
    }
}
