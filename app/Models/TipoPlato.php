<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPlato extends Model
{
    use HasFactory;
    protected $table = "tipo_plato";
    protected $fillable = ['tipo','url_imagen','nombre_imagen','estado'];
    public $timestamps = true;
    public function platos()
    {
        return $this->hasMany(Plato::class,'tipoplato_id');
    }
}
