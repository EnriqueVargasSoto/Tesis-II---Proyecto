<?php

namespace App\Models\Mantenimiento;

use App\Models\Compras\DocCompra;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;
    protected $table ="deposito";
    protected $fillable=[
        'nombre','descripcion','estado'
    ];
    public $timestamps=true;
    public function DocCompra()
    {
        return $this->hasMany(DocCompra::class,'deposito_id');
    }
}
