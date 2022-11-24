<?php

namespace App\Models\Facturar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billete extends Model
{
    use HasFactory;
    protected $table="billete";
    protected $fillable=[
        'billete','abreviatura'
    ];
}
