<?php

namespace App\Models\Abastecimiento;

use App\Models\Plato;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePlato extends Model
{
    use HasFactory;
    protected $table="detalle_plato";
    protected $fillable = [
        'plato_id','insumo_id','cantidad'
    ];
    public $timestamps=true;
    public function insumo() {
        return $this->belongsTo(Insumo::class,'insumo_id');
    }
    public function plato() {
        return $this->belongsTo(Plato::class,'plato_id');
    }

}
