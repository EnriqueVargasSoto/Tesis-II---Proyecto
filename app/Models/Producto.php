<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table="producto";
    protected $fillable=[
        'nombre',
        'precio',
        'url_imagen',
        'nombre_imagen',
        'tipoproducto_id'
    ];
    public function tipo()
    {
        return $this->belongsTo(TipoProducto::class,'tipoproducto_id');
    }
    public function plato()
    {
        return $this->hasOne(Plato::class,'producto_id');
    }
    public function bebida()
    {
        return $this->hasOne(Bebida::class,'producto_id');
    }
}
