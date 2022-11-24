<?php

namespace App\Models\Abastecimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $table="unidad";
    protected $fillable = [
        'nombre','simbolo','estado'
    ];
    public function insumos()
    {
        return $this->hasMany(Insumo::class,'unidad_id');
    }
}
